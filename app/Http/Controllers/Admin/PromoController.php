<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Promo;
class PromoController extends Controller
{
    /**
     * Only Authenticated users for "admin" guard
     * are allowed.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show Admin Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Promo::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('judul', function($row){
                        return '<b>'.$row->judul.'</b>';
                })
                ->addColumn('status', function($row){
                    return $row->status.' '.$row->featured;
                })
                ->addColumn('periode', function($row){

                        return $row->periode;
                })
                ->addColumn('action', function($row){
                    $btn = '<div class="btn-group text-center" role="group">
                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupVerticalDrop3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="si si-wrench mr-1"></i>Aksi</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 34px, 0px);">
                                <a class="dropdown-item" href="'. route('promo.detail', $row->slug) .'" target="_blank" rel="noopener noreferrer">
                                    <i class="si si-eye mr-5"></i>Detail Promo
                                </a>
                                <a class="dropdown-item" href="'. route('admin.promo.edit', $row->id) .'">
                                    <i class="si si-note mr-5"></i>Ubah Promo
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)" onClick="hapus('.$row->id.')">
                                    <i class="si si-trash mr-5"></i>Hapus Promo
                                </a>
                            </div>
                        </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'status', 'tgl', 'judul', 'periode'])
                ->make(true);
        }
        return view('admin.promo.index');

    }

    public function tambah()
    {
        // $kategori = PostKategori::orderBy('nama', 'ASC')->get();
        return view('admin.promo.form');
    }

    public function simpan(Request $request)
    {
        // dd($request->all());
        $rules = [
            'judul' => 'required',
        ];

        $pesan = [
            'judul.required' => 'Judul Berita Wajib Diisi!',
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
                libxml_use_internal_errors(true);
                $dom = new \domdocument();
                $dom->loadHtml($request->deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $deskripsi = $dom->savehtml();

                $data = new Promo();
                $data->judul = $request->judul;
                $data->deskripsi = $deskripsi;
                if(!empty($request->image))
                {
                    // if(!empty($data->logo))
                    // {

                    // }
                    $folderPath = 'promo/';
                    $coverName = $folderPath . uniqid() . '.jpg';
                    list($baseType, $image) = explode(';', $request->image);
                    list(, $image) = explode(',', $image);
                    $image = base64_decode($image);
                    $p = Storage::disk('umum')->put($coverName, $image);
                    $data->image = $coverName;
                }
                $data->tgl_mulai = $request->tgl_mulai;
                $data->tgl_selesai = $request->tgl_selesai;
                // $data->seo_keyword = $request->seo_keyword;
                // $data->seo_description = $request->seo_description;
                // $data->seo_tags = $request->seo_tags;
                $data->is_active = $request->is_active;
                $data->is_featured = $request->is_featured;
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

    public function edit($id)
    {
        $promo = Promo::find($id);
        return view('admin.promo.edit', compact('promo'));
    }

    public function update(Request $request)
    {
        $rules = [
            'judul' => 'required',
        ];

        $pesan = [
            'judul.required' => 'Judul Berita Wajib Diisi!',
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

                $data = Promo::find($request->promo_id);
                $data->judul = $request->judul;

                libxml_use_internal_errors(true);
                $dom = new \domdocument();
                $dom->loadHtml($request->deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

                $data->deskripsi = $dom->savehtml();

                if(!empty($request->image))
                {
                    if(!empty($data->image))
                    {
                        $cek = Storage::disk('public')->exists($data->image);
                        if($cek)
                        {
                            Storage::disk('public')->delete($data->image);
                        }
                    }
                    $folderPath = 'promo/';
                    $coverName = $folderPath . uniqid() . '.jpg';
                    list($baseType, $image) = explode(';', $request->image);
                    list(, $image) = explode(',', $image);
                    $image = base64_decode($image);
                    $p = Storage::disk('umum')->put($coverName, $image);
                    $data->image = $coverName;
                }
                $data->tgl_mulai = $request->tgl_mulai;
                $data->tgl_selesai = $request->tgl_selesai;
                // $data->seo_keyword = $request->seo_keyword;
                // $data->seo_description = $request->seo_description;
                // $data->seo_tags = $request->seo_tags;
                $data->is_active = $request->is_active;
                $data->is_featured = $request->is_featured;
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

    public function hapus($id)
    {
        $post = Post::find($id);
        $cek = Storage::disk('public')->exists($post->featured_img);
        if($cek)
        {
            Storage::disk('public')->delete($post->featured_img);
        }
        $hapus_db = Post::destroy($post->id);
        if($hapus_db)
        {
            return response()->json([
                'fail' => false,
            ]);
        }

    }

    public function hapusFile(Request $request)
    {
        $file_name = str_replace(url('/').'/', '', $request->src);
        $cek = Storage::disk('public')->exists($file_name);
        if($cek)
        {
            $hapus = Storage::disk('public')->delete($file_name);
        }
        $post = Post::find($request->post_id);

        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($request->content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = '/post/images/' . uniqid('', true) . '.' . $mimeType;
                Storage::disk('umum')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $image->setAttribute('src', Storage::disk('umum')->url($path));
            }
        }
        $post->deskripsi = $dom->savehtml();
        $post->save();

        return response()->json([
            'fail' => false,
        ]);
    }
}
