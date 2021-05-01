<?php

namespace App\Http\Controllers\Umum\Auth;

use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('umum.auth.register');
    }

    public function proses(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ];

        $pesan = [
            'nama.required' => 'Nama Lengkap Wajib Diisi!',
            'email.required' => 'Alamat Email Wajib Diisi!',
            'password.required' => 'Password Wajib Diisi!',
            'password.min' => 'Tidak Boleh Kurang Dari 6 Karakter!',
            'password.same' => 'Konfirmasi Password Tidak Sama!',
            'password_confirmation.min' => 'Tidak Boleh Kurang Dari 6 Karakter!'
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()){
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        }else{
            DB::beginTransaction();
            try{
                $data = new User;
                $data->nama = $request->nama;
                $data->email = $request->email;
                $data->password = Hash::make($request->password);
                $data->save();
            }catch(\QueryException $e){
                DB::rollback();
                return response()->json([
                    'fail' => true,
                    'pesan' => 'Error Menyimpan Data',
                    'log' => $e,
                ]);
            }

            DB::commit();
            return response()->json([
                'fail' => false,
            ]);
        }
    }
}
