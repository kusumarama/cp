<?php

namespace App\Http\Controllers\editor;

use Exception;
use App\Models\Portofolio;
use App\Models\PortfolioImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PortofolioController extends Controller
{
    public function index()
    {
        return view('pages.editor.portofolio.index');
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
            $query = Portofolio::where('project_name', 'LIKE', '%'.$cari.'%');
            $portofolio = $query->offset($start)
                ->limit($limit)
                ->get();
            $portofolio_total = $query->count();
            $data['draw'] = intval($request->input('draw'));
            $data['recordsTotal'] = $portofolio_total;
            $data['recordsFiltered'] = $portofolio_total;
            $data['data'] = $portofolio;
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
                'project_name' => 'required|string|max:255|unique:portofolio,project_name',
                'status' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'owner_project' => 'required|string|max:255',
                'alamat' => 'required|string',
                'nilai_kontrak' => 'required|string',
                'jenis_bangunan' => 'required|string|max:255',
                'waktu' => 'required',
                'status_update' => 'required|string|max:255',
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
                
                // Create main portfolio record with first image as featured
                $firstImage = $request->file('images')[0];
                $file_name = Str::uuid().'.'.$firstImage->getClientOriginalExtension();
                $path = $firstImage->storeAs('img', $file_name, 'public');
                
                $portfolioData = [
                    'project_name' => $validData['project_name'],
                    'status' => $validData['status'],
                    'location' => $validData['location'],
                    'owner_project' => $validData['owner_project'],
                    'alamat' => $validData['alamat'],
                    'nilai_kontrak' => $validData['nilai_kontrak'],
                    'jenis_bangunan' => $validData['jenis_bangunan'],
                    'waktu' => $validData['waktu'],
                    'status_update' => $validData['status_update'],
                    'image' => $path,
                    'slug' => Str::slug($validData['project_name'], '-'),
                    'created_by' => $user
                ];
                
                $portfolio = Portofolio::create($portfolioData);
                
                // Store all images in portfolio_images table
                if ($request->hasFile('images')) {
                    $images = $request->file('images');
                    foreach ($images as $index => $image) {
                        $file_name = Str::uuid().'.'.$image->getClientOriginalExtension();
                        $path = $image->storeAs('img/portfolio', $file_name, 'public');
                        
                        PortfolioImage::create([
                            'portofolio_id' => $portfolio->id,
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
        $data = Portofolio::with('images')->find($id);
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
                'project_name' => 'required|string|max:255|unique:portofolio,project_name,'.$id,
                'status' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'owner_project' => 'required|string|max:255',
                'alamat' => 'required|string',
                'nilai_kontrak' => 'required|string',
                'jenis_bangunan' => 'required|string|max:255',
                'waktu' => 'required',
                'status_update' => 'required|string|max:255',
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
                $portfolio = Portofolio::find($id);
                if ($portfolio) {
                    $validData['updated_by'] = $user;
                    $validData['slug'] = Str::slug($validData['project_name'], '-');
                    $portfolio->update($validData);
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
            $portofolio = Portofolio::with('images')->find($id);
            $res = [];
            if ($portofolio) {
                // Delete all associated images from storage
                foreach ($portofolio->images as $image) {
                    if (Storage::disk('public')->exists($image->image_path)) {
                        Storage::disk('public')->delete($image->image_path);
                    }
                }
                
                $portofolio->update(['deleted_by'=>$user]);
                $portofolio->delete();
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
            $image = PortfolioImage::find($imageId);
            
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
            $portfolioId = $request->input('portfolio_id');
            $portfolio = Portofolio::find($portfolioId);
            
            if (!$portfolio) {
                return response()->json(['success' => 0, 'messages' => 'Portfolio not found'], $rescode);
            }
            
            if ($request->hasFile('new_images')) {
                $images = $request->file('new_images');
                $maxOrder = PortfolioImage::where('portofolio_id', $portfolioId)->max('sort_order');
                
                foreach ($images as $index => $image) {
                    $file_name = Str::uuid().'.'.$image->getClientOriginalExtension();
                    $path = $image->storeAs('img/portfolio', $file_name, 'public');
                    
                    PortfolioImage::create([
                        'portofolio_id' => $portfolioId,
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
