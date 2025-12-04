<?php

namespace App\Http\Controllers\editor;

use Exception;
use App\Models\Legality;
use App\Models\LegalityImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LegalityController extends Controller
{
    public function index()
    {
        return view('pages.editor.legality.index');
    }

    public function getData(Request $request): JsonResponse
    {
        $rescode = 200;
        $cari = $request->input('search', '');
        $start = $request->input('start', 0);
        $limit = $request->input('length', 10);
        try {
            $query = Legality::where('title', 'LIKE', '%'.$cari.'%');
            $Legality = $query->offset($start)->limit($limit)->get();
            $Legality_total = $query->count();
            $data['draw'] = intval($request->input('draw'));
            $data['recordsTotal'] = $Legality_total;
            $data['recordsFiltered'] = $Legality_total;
            $data['data'] = $Legality;
        } catch (QueryException $e) {
            $data['error'] = 'Ops terjadi kesalahan saat mengambil data ';
            Log::error('QueryException: '.$e);
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
                'title' => 'required|string|max:255|unique:legality,title',
                'title_id' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'subtitle_id' => 'required|string|max:255',
                'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ];
            $massages = [
                'title.unique' => 'nama sudah digunakan',
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
                $res = ['success' => 0, 'messages' => implode(',', $v_error)];
            } else {
                $validData = $validator->validate();
                $firstImage = $request->file('images')[0];
                $file_name = Str::uuid().'.'.$firstImage->getClientOriginalExtension();
                $path = $firstImage->storeAs('img', $file_name, 'public');
                $legalityData = [
                    'title' => $validData['title'],
                    'subtitle' => $validData['subtitle'],
                    'image' => $path,
                    'slug' => Str::slug($validData['title'], '-'),
                    'created_by' => $user
                ];
                $legality = Legality::create($legalityData);
                if ($request->hasFile('images')) {
                    $images = $request->file('images');
                    foreach ($images as $index => $image) {
                        $file_name = Str::uuid().'.'.$image->getClientOriginalExtension();
                        $path = $image->storeAs('img/legality', $file_name, 'public');
                        LegalityImage::create([
                            'legality_id' => $legality->id,
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
        $data = Legality::with('images')->find($id);
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
                'title' => 'required|string|max:255|unique:legality,title,'.$id,
                'title_id' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'subtitle_id' => 'required|string|max:255',
            ];
            $massages = [
                'title.unique' => 'Title already taken',
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
                $legality = Legality::find($id);
                if ($legality) {
                    $validData['updated_by'] = $user;
                    $validData['slug'] = Str::slug($validData['title'], '-');
                    $legality->update($validData);
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
            $Legality = Legality::with('images')->find($id);
            $res = [];
            if ($Legality) {
                foreach ($Legality->images as $image) {
                    if (Storage::disk('public')->exists($image->image_path)) {
                        Storage::disk('public')->delete($image->image_path);
                    }
                }
                $Legality->update(['deleted_by'=>$user]);
                $Legality->delete();
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
            $image = LegalityImage::find($imageId);
            if ($image) {
                if (Storage::disk('public')->exists($image->image_path)) {
                    Storage::disk('public')->delete($image->image_path);
                }
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
            $legalityId = $request->input('legality_id');
            $legality = Legality::find($legalityId);
            if (!$legality) {
                return response()->json(['success' => 0, 'messages' => 'legality not found'], $rescode);
            }
            if ($request->hasFile('new_images')) {
                $images = $request->file('new_images');
                $maxOrder = LegalityImage::where('legality_id', $legalityId)->max('sort_order');
                foreach ($images as $index => $image) {
                    $file_name = Str::uuid().'.'.$image->getClientOriginalExtension();
                    $path = $image->storeAs('img/legality', $file_name, 'public');
                    LegalityImage::create([
                        'legality_id' => $legalityId,
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
