<?php

namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use App\Models\ProdukVariasi;
use App\Models\ProdukFoto;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Storage;
use Yajra\DataTables\DataTables;

class ProdukController extends Controller
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

    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data = Produk::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('info_produk', function($row){
                return '<div class="media">
                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="'. $row->fotoUtama.'" style="width:45px"> </a>
                <div class="media-body ml-3">
                    <div class="font-size-h6 font-w700 mb-0"><a href="'.route('produk.detail', $row->slug).'" target="_blank">'.ucwords($row->nama).'</a></div>
                    <span class="text-primary">'.$row->kategori->nama.'</span>
                </div>
            </div>';
            })
            ->addColumn('harga', function($row){
                return $row->harga;
            })
            ->addColumn('stok', function($row){
                return $row->stok;
            })
            ->addColumn('aksi', function($row){
                $btn = '<div class="btn-group" role="group">
                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupVerticalDrop3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        OPSI
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 34px, 0px);">
                            <a class="dropdown-item" href="'. route('admin.produk.edit', $row->id) .'">
                                <i class="si si-note mr-5"></i>Ubah
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)" onClick="hapus(`'.$row->id.'`);">
                                <i class="si si-trash mr-5"></i>Hapus
                            </a>
                        </div>
                    </div>';
                return $btn;
            })
            ->rawColumns(['info_produk', 'harga', 'views', 'stok', 'aksi'])
            ->make(true);
        }

        return view('admin.produk.index');
    }

    public function tambah(){
        $kategori = Kategori::where('parent_id', null)->get();

        return view('admin.produk.tambah', compact('kategori'));
    }

    public function simpan(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'deskripsi' => 'required|min:100',
            'kategori' => 'required',
            'foto.0' => 'required',
            'berat' => 'required',
            'material' => 'required',
            'kode' => 'required',
            'kadar' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama Produk Wajib Diisi!',
            'deskripsi.required' => 'Deksripsi Produk Wajib Diisi!',
            'deskripsi.min' => 'Deksripsi Produk Terlalu Sedikit!',
            'kategori.required' => 'Kategori Produk Wajib Diisi!',
            'foto.0.required' => 'Foto Utama Produk Wajib Diisi!',
            'berat.required' => 'Berat Produk Wajib Diisi!',
            'material.required' => 'Metrial Produk wajib Diisi',
            'kode.required' => 'Kode Produk Wajib Diisi',
            'kadar' => 'Kadar (fineness) Produk Wajib Diisi'

        ];

        if($request->is_variasi === '0')
        {
            $rules['harga'] = 'required';
            $rules['stok'] = 'required';

            $pesan['harga.required'] = 'Harga Produk Wajib Diisi!';
            $pesan['stok.required'] = 'Stok Produk Wajib Diisi!';
        }else{
            $rules['var1_nama'] = 'required';
            $rules['var1_pilihan'] = 'required';

            $pesan['var1_nama.required'] = 'Nama Variasi Produk Wajib Diisi!';
            $pesan['var1_pilihan.required'] = 'Pilihan Variasi Produk Wajib Diisi!';
            if($request->var2_status === '1')
            {
                $rules['var2_nama'] = 'required';
                $rules['var2_pilihan'] = 'required';

                $pesan['var2_nama.required'] = 'Nama Variasi Produk Wajib Diisi!';
                $pesan['var2_pilihan.required'] = 'Pilihan Variasi Produk Wajib Diisi!';
            }
        }

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()){
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        }else{
            DB::beginTransaction();
            try{
                $Produkdata = array(
                    'nama' => $request->nama,
                    'kategori_id' => $request->kategori,
                    'has_variasi' => $request->is_variasi,
                    'deskripsi' => $request->deskripsi,
                    'kadar' => $request->kadar,
                    'material' => $request->material,
                    'stok' => $request->stok,
                    'kode' => $request->kode,
                    'ukuran' => $request->ukuran,
                    'jenis_permata' => $request->jenis_permata,
                    'berat_permata' => $request->berat_permata,
                );

                $produk = Produk::create($Produkdata);
                $i = 0;
                foreach ($request->foto as $foto) {
                    if(!empty($foto))
                    {
                        $folderPath = "produk/".$produk->id."/";
                        $imageName = $folderPath . uniqid() . '.jpg';
                        list($baseType, $image) = explode(';', $foto);
                        list(, $image) = explode(',', $image);
                        $image = base64_decode($image);
                        $p = Storage::disk('umum')->put($imageName, $image);

                        $foto = new ProdukFoto;
                        $foto->produk_id = $produk->id;
                        $foto->path = $imageName;
                        if($i === 0){
                            $foto->is_utama = 1;
                        }
                        $foto->save();
                    }
                    $i++;
                }
                if($request->is_variasi === '0')
                {
                    $variasiData = array(
                        'produk_id' => $produk->id,
                        'nama' => '',
                        'sku' => $request->sku,
                        'harga' => $request->harga,
                    );
                    $variasi = ProdukVariasi::create($variasiData);
                }else{
                    $produk->var1_nama = $request->var1_nama;
                    if(count(explode(',', $request->var1_pilihan)) > 0){
                        $produk->var1_value = json_encode(explode(',', $request->var1_pilihan));
                    }
                    if($request->var2_status === '1')
                    {
                        $produk->var2_nama = $request->var2_nama;
                        if(count(explode(',', $request->var2_pilihan)) > 0){
                            $produk->var2_value = json_encode(explode(',', $request->var2_pilihan));
                        }
                    }
                    $produk->save();

                    foreach ($request->variasi as $d) {
                        if($request->var2_status === '1')
                        {
                            $variant = $d['pil1'].'-'.$d['pil2'];
                        }else{
                            $variant = $d['pil1'];
                        }
                        $variasiData = array(
                            'produk_id' => $produk->id,
                            'variant' => $variant,
                            'sku' => $d['sku'],
                            'harga' => $d['harga'],
                            'stok' => $d['stok'],
                            'sku' => $d['sku'],
                        );
                        $variasi = ProdukVariasi::create($variasiData);
                    }
                }
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

    public function edit($produk_id)
    {
        $produk = Produk::find($produk_id);
        $kategori = Kategori::where('parent_id', null)->get();
        $kategorinya = '';
        if($produk->kategori->parent_id !== 'null')
        {
            if($produk->kategori->parent->parent){
                $kategorinya .= $produk->kategori->parent->parent->nama .' > ';
            }

            if($produk->kategori->parent){
                $kategorinya .= $produk->kategori->parent->nama .' > ';
            }
        }
        $kategorinya .= $produk->kategori->nama;
        $produk->kategori_select = $kategorinya;
        $produkFoto = ProdukFoto::where('produk_id', $produk->id)->get()->toArray();
        for($i=0; $i <= 4; $i++)
        {
            if(!array_key_exists($i, $produkFoto)) {
                $foto[$i]['path'] = null;
                $foto[$i]['id'] = null;
            }else{
                $foto[$i]['path'] = $produkFoto[$i]['path'];
                $foto[$i]['id'] = $produkFoto[$i]['id'];
            }
        }
        $variasi = ProdukVariasi::where('produk_id', $produk->id)->get()->toArray();
        return view('admin.produk.edit', compact('produk', 'kategori', 'foto', 'variasi'));
    }

    public function update(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'deskripsi' => 'required|min:100',
            'kategori' => 'required',
            'foto.0' => 'required',
            'berat' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama Produk Wajib Diisi!',
            'deskripsi.required' => 'Deksripsi Produk Wajib Diisi!',
            'deskripsi.min' => 'Deksripsi Produk Terlalu Sedikit!',
            'kategori.required' => 'Kategori Produk Wajib Diisi!',
            'foto.0.required' => 'Foto Utama Produk Wajib Diisi!',
            'berat.required' => 'Berat Produk Wajib Diisi!',
        ];

        if($request->is_variasi === '0')
        {
            $rules['harga'] = 'required';
            $rules['stok'] = 'required';

            $pesan['harga.required'] = 'Harga Produk Wajib Diisi!';
            $pesan['stok.required'] = 'Stok Produk Wajib Diisi!';
        }else{
            $rules['var1_nama'] = 'required';
            $rules['var1_pilihan'] = 'required';

            $pesan['var1_nama.required'] = 'Nama Variasi Produk Wajib Diisi!';
            $pesan['var1_pilihan.required'] = 'Pilihan Variasi Produk Wajib Diisi!';
            if($request->var2_status === '1')
            {
                $rules['var2_nama'] = 'required';
                $rules['var2_pilihan'] = 'required';

                $pesan['var2_nama.required'] = 'Nama Variasi Produk Wajib Diisi!';
                $pesan['var2_pilihan.required'] = 'Pilihan Variasi Produk Wajib Diisi!';
            }
        }

        if($request->variasi == 1)
        {
            $rules['hrg_modal'] = 'required';
            $rules['hrg_jual'] = 'required';

            $pesan['hrg_modal.required'] = 'Harga Modal Produk Wajib Diisi!';
            $pesan['hrg_jual.required'] = 'Harga Jual Produk Wajib Diisi!';

            if($request->has('kelola_stok'))
            {
                $rules['unit'] = 'required';
                $rules['stok_awal'] = 'required';
                $rules['min_stok'] = 'required';

                $pesan['unit.required'] = 'Satuan Unit Stok Produk Wajib Diisi!';
                $pesan['stok_awal.required'] = 'Stok Awal Produk Wajib Diisi!';
                $pesan['min_stok.required'] = 'Minimum Stok Produk Wajib Diisi!';
            }
        }
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()){
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        }else{
            DB::beginTransaction();
            try{
                $produk = Produk::find($request->produk_id);
                $produk->nama = $request->nama;
                $produk->kategori_id = $request->kategori;
                $produk->stok = $request->stok;
                $dom = new \domdocument();
                libxml_use_internal_errors(true);
                $dom->loadHtml($request->deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $produk->deskripsi = $dom->savehtml();
                $produk->has_variasi = $request->is_variasi;
                $produk->var2_status = $request->var2_status;
                $produk->berat = $request->berat;
                $produk->berat_satuan = $request->berat_satuan;
                $produk->panjang = $request->panjang;
                $produk->lebar = $request->lebar;
                $produk->tinggi = $request->tinggi;
                $produk->kadar = $request->kadar;
                $produk->material = $request->material;
                $produk->kode = $request->kode;
                $produk->ukuran = $request->ukuran;
                $produk->jenis_permata = $request->jenis_permata;
                $produk->berat_permata = $request->berat_permata;
                $produk->save();

                if($request->foto_hapus)
                {
                    foreach($request->foto_hapus as $hapus_foto)
                    {
                        $hapusFoto = ProdukFoto::find($hapus_foto);
                        $cek = Storage::disk('umum')->exists($hapusFoto->path);
                        if($cek)
                        {
                            Storage::disk('umum')->delete($hapusFoto->path);
                        }
                        $hapusFoto->delete();
                    }
                }

                $i = 0;
                foreach ($request->foto as $foto) {
                    if(!empty($foto))
                    {
                        if($foto !== "ada")
                        {
                            $folderPath = "produk/".$produk->id."/";
                            $image_parts = explode(";base64,", $foto);
                            $image_type_aux = explode("image/", $image_parts[0]);
                            $image_type = $image_type_aux[1];
                            $image_base64 = base64_decode($image_parts[1]);
                            $file = $folderPath . uniqid() . '.jpg';
                            $p = Storage::disk('umum')->put($file, $image_base64);

                            $produkFoto = new ProdukFoto;
                            $produkFoto->produk_id = $produk->id;
                            $produkFoto->path = $file;
                            if($i === 0){
                                $produkFoto->is_utama = 1;
                            }
                            $produkFoto->save();
                        }
                    }
                    $i++;
                }

                if($request->is_variasi === '0')
                {
                    $variasi = ProdukVariasi::find($request->variasi_id);
                    $variasi->produk_id = $produk->id;
                    $variasi->sku = $request->sku;
                    $variasi->harga = $request->harga;
                    $variasi->save();
                }else{
                    $produk->var1_nama = $request->var1_nama;
                    if(count(explode(',', $request->var1_pilihan)) > 0){
                        $produk->var1_value = json_encode(explode(',', $request->var1_pilihan));
                    }
                    if($request->var2_status === '1')
                    {
                        $produk->var2_nama = $request->var2_nama;
                        if(count(explode(',', $request->var2_pilihan)) > 0){
                            $produk->var2_value = json_encode(explode(',', $request->var2_pilihan));
                        }
                    }
                    $produk->save();

                    if($request->hapus_variasi)
                    {
                        $hv = ProdukVariasi::destroy($request->hapus_variasi);

                    }

                    foreach ($request->variasi as $d) {
                        if(isset($d['id']))
                        {
                            $variasi = ProdukVariasi::find($d['id']);
                        }else{
                            $variasi = new ProdukVariasi();
                        }
                        if($request->var2_status === '1')
                        {
                            $variant = $d['pil1'].'-'.$d['pil2'];
                        }else{
                            $variant = $d['pil1'];
                        }

                        $variasi->produk_id = $produk->id;
                        $variasi->variant = $variant;
                        $variasi->sku = $d['sku'];
                        $variasi->harga = $d['harga'];
                        $variasi->stok = $d['stok'];
                        $variasi->save();
                    }
                }
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
        DB::beginTransaction();
            try{
        $data = Produk::destroy($id);
        $produk_foto = ProdukFoto::where('produk_id', $id)->delete();
        $variasi = ProdukVariasi::where('produk_id', $id)->delete();

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

    public function json(Request $request)
    {
        if($request->ajax())
        {
            $kategori_id = $request->get('kategori_id');
            $merk_id = $request->get('merk_id');
            $cari = $request->get('keyword');

            $produk = Produk::where('kategori_id', 'like', '%' . $kategori_id . '%')
            ->where('merk_id', 'like', '%' . $merk_id . '%')
            ->where('nama', 'like', '%' . $cari . '%')
            ->paginate(6);
            if($produk->toArray()['next_page_url'] == null)
            {
                $next = false;
            }else{
                $next = true;
            }

            if($produk->toArray()['prev_page_url'] == null)
            {
                $prev = false;
            }else{
                $prev = true;
            }
            if($produk->toArray()['from'] == null)
            {
                $nav = 'Data Produk 0 - 0 Dari 0';
            }else{
                $nav = 'Data Produk '. $produk->toArray()['from'] .' - '.$produk->toArray()['to'] .' Dari '.$produk->toArray()['total'];
            }
            return response()->json([
                'fail' => false,
                'navigasi' => $nav,
                'tipe' => $request->get('tipe'),
                'total' => $produk->Total(),
                'current_page' => $produk->toArray()['current_page'],
                'next_page' => $next,
                'prev_page' => $prev,
                'html' => view('penjualan.include.produk_list', compact('produk'))->render(),
            ]);

        }
    }
}
