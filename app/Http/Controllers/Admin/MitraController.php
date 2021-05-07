<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class MitraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        if ($request->ajax()){
            $data = User::latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama', function($row){
                return $row->nama;
            })
            ->addColumn('kontak', function($row){
                return $row->kontak;
            })
            ->addColumn('alamat', function($row){
                return $row->alamat;
            })
            ->addColumn('aksi', function($row){
                $btn = '<div class="btn-group" role="group">
                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupVerticalDrop3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        OPSI
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 34px, 0px);">
                            <a class="dropdown-item" href="http://localhost/re-diagem/admin/reseller/edit/'. $row->id .'">
                                <i class="si si-note mr-5"></i>Ubah
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)" onClick="hapus(`'.$row->id.'`);">
                                <i class="si si-trash mr-5"></i>Hapus
                            </a>
                        </div>
                    </div>';
                return $btn;
            })
            ->rawColumns(['nama', 'kontak', 'alamat', 'aksi'])
            ->make(true);
        }

        return view('admin.mitra.index');
    }

    public function tambah(){
        return view('admin.mitra.tambah');
    }
    
    public function simpan(Request $request){
        $rules = [
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama Mitra Wajib Diisi',
            'username.required' => 'Username Mitra Wajib Diisi',
            'email.required' => 'Email Mitra Wajib Diisi',
            'password.required' => 'Kata Sandi Mitra Wajib Diisi',
            'alamat.required' => 'Alamat Mitra Wajib Diisi',
            'kontak.required' => 'Kontak Mitra Wajib Diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);

        if ($validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        } else {
            DB::beginTransaction();
            try {
                $MitraData = array(
                    'nama' => $request->nama,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'alamat' => $request->alamat,
                    'kontak' => $request->kontak,
                );
                Mitra::create($MitraData);
            } catch (\QueryException $e) {
                DB::rollback()();
                return response()->json([
                    'fail' => false,
                ]);
            }
            DB::commit();
            return response()->json([
                'fail' => false,
            ]);
        }
    }
    
    public function edit($mitra_id){
        $mitra = User::find($mitra_id);
        return view('admin.mitra.edit', compact('mitra'));
    }

    public function update(Request $request){
        $rules = [
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama Mitra Wajib Diisi',
            'username.required' => 'Username Mitra Wajib Diisi',
            'email.required' => 'Email Mitra Wajib Diisi',
            'password.required' => 'Kata Sandi Mitra Wajib Diisi',
            'alamat.required' => 'Alamat Mitra Wajib Diisi',
            'kontak.required' => 'Kontak Mitra Wajib Diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);

        if ($validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        } else {
            DB::beginTransaction();
            try {
                $mitra = Mitra::find($request->id);
                $mitra->nama = $request->nama;
                $mitra->username = $request->username;
                $mitra->email = $request->email;
                $mitra->alamat = $request->alamat;
                $mitra->kontak = $request->kontak;
                $mitra->save();
            } catch (\QueryException $e) {
                DB::rollback()();
                return response()->json([
                    'fail' => false,
                ]);
            }
            DB::commit();
            return response()->json([
                'fail' => false,
            ]);
        }
    }

    public function update_password(Request $request){
        $rules = [
            'password' => 'min:6|required_with:conf_password|same:conf_password',
            'conf_password' => 'min:6'
        ];

        $pesan = [
            'password.required' => 'Password Wajib Diisi!',
            'password.min' => 'Tidak Boleh Kurang Dari 6 Karakter!',
            'password.same' => 'Konfirmasi Password Tidak Sama!',
            'conf_password.min' => 'Tidak Boleh Kurang Dari 6 Karakter!'
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);

        if ($validator->fails()) {
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        } else {
            DB::beginTransaction();
            try {
                $mitra = User::find($request->id);
                $mitra->password = Hash::make($request->password);
                $mitra->save();
            } catch (\QueryException $e) {
                DB::rollback()();
                return response()->json([
                    'fail' => false,
                ]);
            }
            DB::commit();
            return response()->json([
                'fail' => false,
            ]);
        }
    }

    public function delete($mitra_id){
        DB::beginTransaction();
        try {
            User::destroy($mitra_id);
        } catch (\QueryException $e) {
            DB::rollback();
            return response()->json([
                'fail' => true,
                'pesan' => $e
            ]);
        }
        DB::commit();
        return response()->json([
            'fail' => false,
        ]);
    }
}



