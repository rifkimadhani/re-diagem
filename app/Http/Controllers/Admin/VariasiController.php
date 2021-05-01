<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Produk;
use App\Models\ProdukVariasi;
use App\Models\VariasiDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Storage;

class VariasiController extends Controller
{
    /**
     * Only Authenticated users are allowed.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add_variasi(Request $request)
    {
        // dd($request->all());
        $variasi = array();
        $data = ProdukVariasi::where('produk_id', $request->produk_id)->get()->toArray();
        $pil1 = explode(',', $request->pil1);
        $i = 0;
        if($request->var2_status === '1'){
            $pil2 = explode(',', $request->pil2);
            foreach($pil1 as $a)
            {
                foreach($pil2 as $b)
                {
                    if(isset($data[$i]) && get_variant($data[$i]['variant']) === $a)
                    {
                        $variasi[$i]['pil1'] = get_variant($data[$i]['variant'], 1);
                        $variasi[$i]['harga'] = number_format($data[$i]['harga'],0,',','');
                        $variasi[$i]['stok'] = $data[$i]['stok'];
                        $variasi[$i]['sku'] = $data[$i]['sku'];
                        $variasi[$i]['id'] = $data[$i]['id'];
                        if(!empty(get_variant($data[$i]['variant'], 2)) && get_variant($data[$i]['variant'],2) === $b)
                        {
                            $variasi[$i]['pil2'] = get_variant($data[$i]['variant'], 2);
                        }else{
                            $variasi[$i]['pil2'] = $b;
                        }
                    }else{
                        $variasi[$i]['pil1'] = $a;
                        $variasi[$i]['pil2'] = $b;
                        $variasi[$i]['harga'] = null;
                        $variasi[$i]['stok'] = null;
                        $variasi[$i]['sku'] = null;
                        $variasi[$i]['id'] = null;
                    }
                    $i++;
                }
            }
        }else{
            foreach($pil1 as $a)
            {
                if(isset($data[$i]) && get_variant($data[$i]['variant']) === $a)
                {
                    $variasi[$i]['pil1'] = get_variant($data[$i]['variant']);
                    $variasi[$i]['harga'] = number_format($data[$i]['harga'],0,',','');
                    $variasi[$i]['stok'] = $data[$i]['stok'];
                    $variasi[$i]['sku'] = $data[$i]['sku'];
                    $variasi[$i]['id'] = $data[$i]['id'];
                }else{
                    $variasi[$i]['pil1'] = $a;
                    $variasi[$i]['harga'] = null;
                    $variasi[$i]['stok'] = null;
                    $variasi[$i]['sku'] = null;
                    $variasi[$i]['id'] = null;
                }
                $variasi[$i]['pil2'] = null;
                $i++;
            }
        }
        return response()->json([
            'fail' => false,
            'html' => view('mitra.produk.include.variasi', compact('variasi'))->render(),
        ]);
    }

    public function get_variasi(Request $request)
    {


        return response()->json([
            'fail' => false,
            'html' => view('mitra.produk.include.variasi_edit', compact('variasi'))->render(),
        ]);
    }
}
