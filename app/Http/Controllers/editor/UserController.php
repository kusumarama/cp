<?php

namespace App\Http\Controllers\editor;

use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.editor.user.index');
    }


public function getData(Request $request): JsonResponse
{


    $rescode = 200;
    $cari = $request->input('search', '');
    $start = $request->input('start', 0);
    $limit = $request->input('limit', 10);

    try{
        $query = User::where('name', 'like', "%$cari%");
        $users = $query->offset($start)->limit($limit)->get();
        $users_total = $query->count();
        $data ['data'] = intval($request->input('draw'));
        $data ['recordsTotal'] = $users_total;
        $data ['recordsFiltered'] = $users_total;
        $data ['data'] = $users;
    } catch(QueryException $e){
        $data ['error'] = 'Oops terjadi kesalahan saat mengambil data user ';
        log::error('QueryException: ' . $e);
    } catch(Exception $e){
        $data ['error'] = 'Oops terjadi kesalahan pada server ';
        log::error('Exception: ' . $e);
    }

    return response()->json($data, $rescode);
}


public function storeData(Request $request): JsonResponse
{
   date_default_timezone_set('Asia/Jakarta');
   $rescode = 200;

   try{
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email:dns|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
        $messages = [
            'required' => ':attribute wajib diisi',
                'string' => ':attribute harus bertipe string',
                'max' => ':attribute tidak boleh lebih dari :max',
                'email' => 'Email tidak valid.',
                'email.dns' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan, silakan pilih yang lain.',
                'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules, $messages);

        if($validator->fails()){
            $v_error = $validator->errors()->all();
            $res = ['success' => 0, 'messages' => implode(',', $v_error)];
        } else {
            $validData = $validator->validate();
            $validData ['password'] = Hash::make($validData ['password']);
            $in = User::create($validData);
            $res = ['success' => 1, 'messages' => 'Sukses tambah data.'];
        }
   }catch(QueryException $e){
        $res = ['success' => 0, 'messages' => 'Oops terjadi kesalahan saat menyimpan data user.'];
        log::error('QueryException: '.$e);
   } catch(Exception $e){
        $res = ['success' => 0, 'messages' => 'Oops terjadi kesalahan pada server.'];
        log::error('Exception: '.$e);
   }

    return response()->json($res, $rescode);
}

public function detail(Request $request): JsonResponse
{
    $rescode = 200;
    $id = $request->input('id',0);
    $user = User::find($id);
    $res = [];
    if($user){
        $res = ['success' => 1, 'data' => $user];
    } else {
        $res = ['success' => 0, 'messages' => 'Data tidak ditemukan.'];
    }
    return response()->json($res, $rescode);
}

public function updateData(Request $request): JsonResponse
{
    date_default_timezone_set('Asia/Jakarta');
    $rescode = 200;
    $id = $request->input('id',0);
    try{
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email:dns|max:255',
        ];
        $messages = [
            'required' => ':attribute wajib diisi',
                'string' => ':attribute harus bertipe string',
                'max' => ':attribute tidak boleh lebih dari :max',
                'email' => 'Email tidak valid.',
                'email.dns' => 'Format email tidak valid.',
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules, $messages);
        if($validator->fails()){
            $v_error = $validator->errors()->all();
            $res = ['success' => 0, 'messages' => implode(',', $v_error)];
        } else {
            $validData = $validator->validate();
            $user = User::find($id);
            if($user){
                $user->update($validData);
                $res = ['success' => 1, 'messages' => 'Sukses update data.'];
            } else {
                $res = ['success' => 0, 'messages' => 'Data tidak ditemukan.'];
            }
        }
    } catch(QueryException $e){
        $res = ['success' => 0, 'messages' => 'Oops terjadi kesalahan saat mengupdate data user.'];
        log::error('QueryException: '.$e);
    } catch(Exception $e){
        $res = ['success' => 0, 'messages' => 'Oops terjadi kesalahan pada server.'];
        log::error('Exception: '.$e);
    }
    return response()->json($res, $rescode);
}

public function deleteData(Request $request): JsonResponse
{
    date_default_timezone_set('Asia/Jakarta');
    $rescode = 200;
    $id = $request->input('id');
    try{
        $user = User::find($id);
        $res = [];
        if ($user){
            $user->delete();
            $res = ['success' => 1, 'messages' => 'Sukses hapus data.'];
        } else {
            $res = ['success' => 0, 'messages' => 'Data tidak ditemukan.'];
        }
    } catch(QueryException $e){
        $res = ['success' => 0, 'messages' => 'Oops terjadi kesalahan saat menghapus data user.'];
        log::error('QueryException: ' . $e->getMessage());
    } catch(Exception $e){
        $res = ['success' => 0, 'messages' => 'Oops terjadi kesalahan pada server.'];
        log::error('Exception: ' . $e->getMessage());
    }
    return response()->json($res, $rescode);
    }   
}