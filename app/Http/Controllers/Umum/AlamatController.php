<?php

namespace App\Http\Controllers\Umum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Alamat;
use Yajra\DataTables\DataTables;

class AlamatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user()->id;
            $data = Alamat::where('user_id', $user)->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('is_utama', function($row){
                return  '<div class="form-check">
                            <input class="form-check-input" type="radio" name="is_utama">
                        </div>';
            })
            ->addColumn('penerima', function($row){
                return  $row->nama.'<br>'.$row->penerima.'<br>'.$row->phone;
            })
            ->addColumn('alamat', function($row){
                $alamat  = ucwords(strtolower($row->kelurahan->name)).', ';
                $alamat .= ucwords(strtolower($row->kelurahan->kecamatan->name)).'<br>';
                $alamat .= ucwords(strtolower($row->kelurahan->kecamatan->kota->name)).', ';
                $alamat .= ucwords(strtolower($row->kelurahan->kecamatan->kota->provinsi->name)).', ';
                $alamat .= $row->kd_pos;
                return $row->alamat.'<br>'.$alamat;
            })
            ->addColumn('pin', function($row){
                return 'i';
            })
            ->addColumn('aksi', function($row){
                    $btn = '<center><button  type="button" class="btn btn-outline-primary btn-sm mr-1 btn-edit_alamat" onclick="edit('. $row->id .');"><i class="fa fa-edit mr-1"></i>Edit</button>';
                    $btn .= '<button type="button"class="btn btn-danger btn-sm btn-hapus_alamat" data-id="'. $row->id .'"><i class="fa fa-trash mr-1"></i>Hapus</button></center>';
                    return $btn;
            })
            ->rawColumns(['is_utama','penerima', 'alamat', 'daerah', 'pin', 'aksi'])
            ->make(true);
        }
        return view('umum.user.alamat');
    }


    public function simpan(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'penerima' => 'required',
            'alamat' => 'required',
            'phone' => 'required',
            'kelurahan_id' => 'required',
            'pos' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama Alamat Wajib Diisi!',
            'penerima.required' => 'Nama Penerima Wajib Diisi!',
            'alamat.required' => 'Alamat Lengkap Wajib Diisi!',
            'phone.required' => 'No. Handphone Wajib Diisi!',
            'kelurahan_id.required' => 'Kelurahan / Desa Wajib Diisi!',
            'pos.required' => 'Kode POS Wajib Diisi!',
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
                $data = array(
                    'user_id' => auth()->user()->id,
                    'nama' => $request->nama,
                    'penerima' => $request->penerima,
                    'phone' => $request->phone,
                    'kelurahan_id' => $request->kelurahan_id,
                    'kd_pos' => $request->pos,
                    'alamat' => $request->alamat,
                    // 'lat' => $request->lat,
                    // 'lng' => $request->lng
                );

                Alamat::create($data);

            }catch(\QueryException $e){
                DB::rollback();
                return response()->json([
                    'fail' => true,
                    'pesan' => 'gagal',
                    'log' => $e,
                ]);
            }
            DB::commit();
            return response()->json([
                'fail' => false,
            ]);
        }
    }

    public function edit($id){
        $data = Alamat::find($id);
        if($data){
            return response()->json($data);
        }
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $rules = [
            'nama' => 'required',
            'penerima' => 'required',
            'alamat' => 'required',
            'phone' => 'required',
            'kelurahan_id' => 'required',
            'pos' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama Alamat Wajib Diisi!',
            'penerima.required' => 'Nama Penerima Wajib Diisi!',
            'alamat.required' => 'Alamat Lengkap Wajib Diisi!',
            'phone.required' => 'No. Handphone Wajib Diisi!',
            'kelurahan_id.required' => 'Kelurahan / Desa Wajib Diisi!',
            'pos.required' => 'Kode POS Wajib Diisi!',
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

                $alamat = Alamat::where('id', $request->id)->where('user_id', auth()->user()->id)->first();
                $alamat->nama = $request->nama;
                $alamat->penerima = $request->penerima;
                $alamat->phone = $request->phone;
                $alamat->kelurahan_id = $request->kelurahan_id;
                $alamat->kd_pos = $request->pos;
                $alamat->alamat = $request->alamat;
                $alamat->save();
                    // 'lat' => $request->lat,
                    // 'lng' => $request->lng
                // );

            }catch(\QueryException $e){
                DB::rollback();
                return response()->json([
                    'fail' => true,
                    'pesan' => 'gagal',
                    'log' => $e,
                ]);
            }
            DB::commit();
            return response()->json([
                'fail' => false,
            ]);
        }
    }

    public function hapus($id){
        $data = Alamat::destroy($id);
        if($data){
            return response()->json($data);
        }
    }

    public function json()
    {
        $user = auth()->user()->id;
        $data = Alamat::where('user_id', $user)->get()->toArray();
        return response()->json([
            'fail' => false,
            'data' => $data,
        ]);
    }
}
