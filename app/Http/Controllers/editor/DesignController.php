<?php

namespace App\Http\Controllers\editor;

use Exception;
use App\Models\Design;
use App\Models\DesignImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DesignController extends Controller
{
    public function index()
    {
        return view('pages.editor.design.index');
    }

    public function getData(Request $request): JsonResponse
    {
        $rescode = 200;
        // DataTables sends 'search' (string) from our client and 'start'/'length'
        $cari = $request->input('search', '');
        $start = $request->input('start', 0);
        // DataTables sends page size as 'length'
        $limit = $request->input('length', 10);
        try {
            $query = Design::where('project_name', 'LIKE', '%'.$cari.'%');
            $Design = $query->offset($start)
                ->limit($limit)
                ->get();
            $Design_total = $query->count();
            $data['draw'] = intval($request->input('draw'));
            $data['recordsTotal'] = $Design_total;
            $data['recordsFiltered'] = $Design_total;
            $data['data'] = $Design;
        } catch (QueryException $e) {
            $data['error'] = 'Ops terjadi kesalahan saat mengambil data ';
            Log::error('QueryException: '.$e);
            //throw $th;
        } catch (Exception $e) {
            $data['error'] = 'Ops terjadi kesalahan pada server';
            Log::error('Exception: '.$e);
        }

        return response()->json($data, $rescode);
    }

    public function storeData(Request $request): JsonResponse
    {
        date_default_timezone_set('Asia/Jakarta');
        $rescode = 200;
        $user = Auth::user()->id;
        try {
            $rules = [
                'project_name' => 'required|string|max:255|unique:design,project_name',
                // 'status' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'owner_project' => 'required|string|max:255',
                // 'alamat' => 'required|string',
                // 'nilai_kontrak' => 'required|string',
                'jenis_bangunan' => 'required|string|max:255',
                // 'waktu' => 'required',
                // 'status_update' => 'required|string|max:255',
                'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ];
            $massages = [
                'project_name.unique' => 'nama sudah digunakan',
                'required' => ':attribute wajib diisi',
                'string' => ':attribute harus bertipe string',
                'max' => ':attribute tidak boleh lebih dari 2MB',
                'images.*.image' => 'File harus berupa gambar',
                'images.*.mimes' => 'Tipe gambar hanya boleh jpeg, png, jpg',
                
            ];
            $data = $request->all();
            $validator = Validator::make($data, $rules, $massages);
            if ($validator->fails()) {
                $v_error = $validator->errors()->all();
                // Jika validasi gagal, kembalikan pesan kesalahan
                $res = ['success' => 0, 'messages' => implode(',', $v_error)];
            } else {
                $validData = $validator->validate();
                
                // Create main design record with first image as featured
                $firstImage = $request->file('images')[0];
                $file_name = Str::uuid().'.'.$firstImage->getClientOriginalExtension();
                $path = $firstImage->storeAs('img', $file_name, 'public');
                
                $designData = [
                    'project_name' => $validData['project_name'],
                    // 'status' => $validData['status'],
                    'location' => $validData['location'],
                    'owner_project' => $validData['owner_project'],
                    // 'alamat' => $validData['alamat'],
                    // 'nilai_kontrak' => $validData['nilai_kontrak'],
                    'jenis_bangunan' => $validData['jenis_bangunan'],
                    // 'waktu' => $validData['waktu'],
                    // 'status_update' => $validData['status_update'],
                    'image' => $path,
                    'slug' => Str::slug($validData['project_name'], '-'),
                    'created_by' => $user
                ];
                
                $design = Design::create($designData);
                
                // Store all images in design_images table
                if ($request->hasFile('images')) {
                    $images = $request->file('images');
                    foreach ($images as $index => $image) {
                        $file_name = Str::uuid().'.'.$image->getClientOriginalExtension();
                        $path = $image->storeAs('img/design', $file_name, 'public');
                        
                        DesignImage::create([
                            'design_id' => $design->id,
                            'image_path' => $path,
                            'sort_order' => $index
                        ]);
                    }
                }
                
                $res = ['success' => 1, 'messages' => 'Success Tambah Data'];
            }
        } catch (QueryException $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan saat Proses data'];
            Log::error('QueryException: '.$e);
        } catch (Exception $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan pada server'];
            Log::error('Exception: '.$e);
        }

        return response()->json($res, $rescode);
    }

    public function detail(Request $request): JsonResponse
    {
        $rescode = 200;
        $id = $request->input('id', 0);
        $data = Design::with('images')->find($id);
        $res = [];
        if ($data) {
            $res = ['success' => 1, 'data' => $data];
        } else {
            $res = ['success' => 0, 'messages' => 'Data tidak ditemukan'];
        }

        return response()->json($res, $rescode);
    }
    public function updateData(Request $request): JsonResponse
    {
        date_default_timezone_set('Asia/Jakarta');
        $rescode = 200;
        $user = Auth::user()->id;
        $id = $request->input('id', 0);
        try {
            $rules = [
                'project_name' => 'required|string|max:255|unique:design,project_name,'.$id,
                // 'status' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'owner_project' => 'required|string|max:255',
                // 'alamat' => 'required|string',
                // 'nilai_kontrak' => 'required|string',
                'jenis_bangunan' => 'required|string|max:255',
                // 'waktu' => 'required',
                // 'status_update' => 'required|string|max:255',
            ];
            $massages = [
                'project_name.unique' => 'Project name already taken',
                'required' => ':attribute wajib diisi',
                'string' => ':attribute harus bertipe string',
                'max' => ':attribute tidak boleh lebih dari :max',
            ];
            $data = $request->all();
            $validator = Validator::make($data, $rules, $massages);
            if ($validator->fails()) {
                $v_error = $validator->errors()->all();
                $res = ['success' => 0, 'messages' => implode(',', $v_error)];
            } else {
                $validData = $validator->validate();
                $design = Design::find($id);
                if ($design) {
                    $validData['updated_by'] = $user;
                    $validData['slug'] = Str::slug($validData['project_name'], '-');
                    $design->update($validData);
                    $res = ['success' => 1, 'messages' => 'Success Update Data'];
                } else {
                    $res = ['success' => 0, 'messages' => 'Data tidak ditemukan'];
                }
            }
        } catch (QueryException $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan saat update data'];
            Log::error('QueryException: '.$e);
        } catch (Exception $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan pada server'];
            Log::error('Exception: '.$e);
        }

        return response()->json($res, $rescode);
    }
    public function deleteData(Request $request): JsonResponse
    {
        date_default_timezone_set('Asia/Jakarta');
        $rescode = 200;
        $user = Auth::user()->id;
        $id = $request->input('id', 0);
        try {
            $Design = Design::with('images')->find($id);
            $res = [];
            if ($Design) {
                // Delete all associated images from storage
                foreach ($Design->images as $image) {
                    if (Storage::disk('public')->exists($image->image_path)) {
                        Storage::disk('public')->delete($image->image_path);
                    }
                }
                
                $Design->update(['deleted_by'=>$user]);
                $Design->delete();
                $res = ['success' => 1, 'messages' => 'Success Delete Data'];
            } else {
                $res = ['success' => 0, 'messages' => 'Data tidak ditemukan'];
            }
        } catch (QueryException $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan saat hapus data '];
            Log::error('QueryException: '.$e->getMessage());
        } catch (Exception $e) {
            $res = ['success' => 0, 'messages' => 'Ops terjadi kesalahan pada server '.$e];
            Log::error('Exception: '.$e->getMessage());
        }

        return response()->json($res, $rescode);
    }

    public function deleteImage(Request $request): JsonResponse
    {
        $rescode = 200;
        try {
            $imageId = $request->input('image_id');
            $image = DesignImage::find($imageId);
            
            if ($image) {
                // Delete from storage
                if (Storage::disk('public')->exists($image->image_path)) {
                    Storage::disk('public')->delete($image->image_path);
                }
                // Delete from database
                $image->delete();
                $res = ['success' => 1, 'messages' => 'Image deleted successfully'];
            } else {
                $res = ['success' => 0, 'messages' => 'Image not found'];
            }
        } catch (Exception $e) {
            $res = ['success' => 0, 'messages' => 'Error deleting image'];
            Log::error('Exception: '.$e->getMessage());
        }
        
        return response()->json($res, $rescode);
    }

    public function addImages(Request $request): JsonResponse
    {
        $rescode = 200;
        try {
            $designId = $request->input('design_id');
            $design = Design::find($designId);
            
            if (!$design) {
                return response()->json(['success' => 0, 'messages' => 'design not found'], $rescode);
            }
            
            if ($request->hasFile('new_images')) {
                $images = $request->file('new_images');
                $maxOrder = DesignImage::where('design_id', $designId)->max('sort_order');
                
                foreach ($images as $index => $image) {
                    $file_name = Str::uuid().'.'.$image->getClientOriginalExtension();
                    $path = $image->storeAs('img/design', $file_name, 'public');
                    
                    DesignImage::create([
                        'design_id' => $designId,
                        'image_path' => $path,
                        'sort_order' => ($maxOrder ?? 0) + $index + 1
                    ]);
                }
                
                $res = ['success' => 1, 'messages' => 'Images added successfully'];
            } else {
                $res = ['success' => 0, 'messages' => 'No images provided'];
            }
        } catch (Exception $e) {
            $res = ['success' => 0, 'messages' => 'Error adding images'];
            Log::error('Exception: '.$e->getMessage());
        }
        
        return response()->json($res, $rescode);
    }
}

