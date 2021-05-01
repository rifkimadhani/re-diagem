<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Kategori;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Storage;
class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        // $data = Kategori::where('parent_id', null)->orderby('created_at', 'DESC')->first();
        if ($request->ajax()) {

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('nama', function($row){
                    return $row->nama;
            })
            ->addColumn('jumlah', function($row){
                return $row->produk()->count();
            })
            ->addColumn('action', function($row){
                    $btn = '<button type="button" onClick="edit(\''.$row->id.'\')" class="btn btn-alt-primary btn-sm mr-5"><i class="si si-note mr-5"></i>Ubah</button>';
                    $btn .= '<button type="button" onClick="hapus(\''.$row->id.'\')" class="btn btn-alt-danger btn-sm"><i class="si si-trash mr-5"></i>Hapus</button>';

                    return $btn;
            })
            ->rawColumns(['nama', 'jumlah', 'action'])
            ->make(true);
        }

        return view('admin.produk.kategori');
    }

    public function simpan(Request $request)
    {
        $rules = [
            'nama' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama Kategori Wajib Diisi!',
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
                    $data = new Kategori();
                    $data->nama = $request->nama;
                    $data->parent_id = $request->parent_id;
                    if(!empty($request->thumbnail))
                    {
                        $thumbPath = 'kategori/thumbnail/';
                        $thumbName = $thumbPath . uniqid() . '.jpg';
                        $image_parts = explode(";base64,", $request->thumbnail);
                        $thumb = base64_decode($image_parts[1]);
                        $p = Storage::disk('umum')->put($thumbName, $thumb);
                        $data->thumbnail = $thumbName;
                        
                    }
                    $data->save();
                Kategori::fixTree();
            }catch(\QueryException $e){
                DB::rollback();
                return response()->json([
                    'fail' => true,
                    'pesan' => $e,
                ]);
            }
            DB::commit();
            return response()->json([
                'fail' => false,
            ]);
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'nama' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama Kategori Wajib Diisi!',
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
                $data = Kategori::find($request->kategori_id);
                if(!empty($request->thumbnail))
                {
                    $cek = Storage::disk('umum')->exists($data->thumbnail);
                    if($cek)
                    {
                        Storage::disk('umum')->delete($data->thumbnail);
                    }
                    $thumbPath = 'c/thumbnail/';
                    $thumbName = $thumbPath . uniqid() . '.jpg';
                    list($baseType, $thumb) = explode(';', $request->thumbnail);
                    list(, $thumb) = explode(',', $thumb);
                    $thumb = base64_decode($thumb);
                    $p = Storage::disk('umum')->put($thumbName, $thumb);
                    $data->thumbnail = $thumbName;
                }
                $data->nama = $request->nama;
                $data->save();
            }catch(\QueryException $e){
                DB::rollback();
                return response()->json([
                    'fail' => true,
                    'pesan' => $e,
                ]);
            }
            DB::commit();
            return response()->json([
                'fail' => false,
            ]);
        }
    }

    public function edit($id){
        $data = Kategori::find($id);
        if($data){
            return response()->json($data);
        }
    }

    public function hapus($id)
    {
        $data = Kategori::find($id);
        $cek = Storage::disk('public')->exists($data->icon);
        if($cek)
        {
            Storage::disk('public')->delete($data->icon);
        }
        $hapus_db = Kategori::destroy($data->id);
        if($hapus_db)
        {
            return response()->json([
                'fail' => false,
            ]);
        }
    }

    public function tree(Request $request)
    {
        $items = Kategori::select('id', 'nama as text', 'parent_id')->get();
        $children = array();

        foreach($items as $item)
            $children[$item->parent_id][] = $item;

        foreach($items as $item)
            if (isset($children[$item->id]))
            $item->children = $children[$item->id];

        $tree = reset($children);

        return response()->json($tree);
    }

    public function json(Request $request)
    {
        if(!isset($request->searchTerm)){
            $fetchData = Kategori::orderBy('created_at', 'DESC')->get();
          }else{
            $cari = $request->searchTerm;
            $fetchData = Kategori::where('nama','LIKE',  '%' . $cari .'%')->orderBy('created_at', 'DESC')->get();
          }

          $data = array();
          foreach($fetchData as $row) {
            $data[] = array("id" =>$row->id, "text"=>$row->nama);
          }

          return response()->json($data);
    }

    function categoriesToTree($items) {

        $childs = array();

        foreach($items as $item)
        {
            // $childs[$item['parent_id']][] = ;
            // unset($item);
        }
        // foreach($items as $item)
        // {
        //     if (isset($childs[$item['id']]))
        //     {
        //         $item['children'] = $childs[$item['id']];
        //     }
        // }

        return $childs;

    }
}
