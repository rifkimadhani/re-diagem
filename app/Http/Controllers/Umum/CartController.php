<?php

namespace App\Http\Controllers\Umum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProdukVariasi;
use App\Models\Cart;
use App\Models\Alamat;
use Illuminate\Support\Facades\DB;
class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('umum.cart.index');
    }

    public function data(Request $request)
    {
        $cart = Cart::where('user_id', auth()->guard('web')->user()->id)->orderBy('updated_at', 'DESC')->get();
        // dd($cart);
        return response()->json([
            'fail' => false,
            'html' => view('umum.cart.include.data-cart', compact('cart'))->render(),
        ]);
    }

    public function addToCart(Request $request)
    {
        DB::beginTransaction();
        try{
            $user = auth()->guard('web')->user()->id;
            if($request->has_variasi === '1')
            {
                if($request->has('var2'))
                {
                    $variant = $request->var1.'-'.$request->var2;
                }else{
                    $variant = $request->var1;
                }
                $produk = ProdukVariasi::where('variant', $variant)->where('produk_id', $request->id)->first();
            }else{
                $produk = ProdukVariasi::where('produk_id', $request->id)->first();
            }
            // dd($produk);
            $cart = Cart::where('user_id', $user)->where('produk_id', $produk->produk_id)->where('variasi_id', $produk->id)->first();
            if(empty($cart))
            {
                $cart = new Cart();
                $cart->user_id = $user;
                $cart->produk_id = $produk->produk_id;
                $cart->variasi_id = $produk->id;
                $cart->harga = $produk->harga;
                $cart->qty = 0;
            }
            $cart->qty += $request->quantity;
            $cart->save();
            
            $resp = array(
                'id' => $cart->id,
                'produk_nama' => $cart->produk_nama,
                'produk_img' => $produk->produk->fotoUtama,
                'produk_price' => $cart->harga_frm.' x ('. $request->quantity.') barang',
                'produk_subtotal' => "Rp" .number_format($cart->harga * $request->quantity,0,',','.'),
                'incr' => $cart->qty,
            );
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
            'data' => $resp,
        ]);
    }

    public function updateQuantity(Request $request)
    {
        DB::beginTransaction();
        try{
            $cart = Cart::find($request->cart_id);
            $cart->qty = $request->qty;
            $cart->save();
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
            'total' => $cart->qty,
        ]);
    }

    public function hapus(Request $request) {
        // dd($request->all());
        DB::beginTransaction();
        try{
            Cart::destroy($request->c_id);
        }catch(\QueryException $e){
            DB::rollback();
            return response()->json([
                'fail' => true,
                'pesan' => 'Error Database',
                'log' => $e,
            ]);
        }
        DB::commit();
        return response()->json([
            'fail' => false,
        ]);
    }
}
