<?php

namespace App\Http\Controllers\Umum;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Produk;
use App\Models\ProdukVariasi;
use App\Models\ProdukFoto;
use App\Models\Kategori;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function detail($produk)
    {
        $produk = Produk::where('slug', $produk)->first();
        $Produkfoto = ProdukFoto::where('produk_id', $produk->id)->get();
        // $mitra = Bisnis::find()
        return view('umum.produk_detail', compact('produk', 'Produkfoto'));
    }

    public function kategori($kategori)
    {

    }

    public function variant_price(Request $request)
    {
        $variant = $request->var1.'-'.$request->var2;
        if($request->has_variasi === '1')
        {
            $produk = ProdukVariasi::where('variant', $variant)->where('produk_id', $request->id)->first();
        }else{
            $produk = ProdukVariasi::where('produk_id', $request->id)->first();
        }
        $total = $request->quantity * $produk->harga;
        return response()->json([
            'fail' => false,
            'harga' => "Rp" .number_format($produk->harga,0,',','.'),
            'stok' => $produk->stok,
            'total' => "Rp" .number_format($total,0,',','.')
        ]);
    }
}
