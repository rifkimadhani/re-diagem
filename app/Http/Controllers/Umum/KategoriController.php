<?php

namespace App\Http\Controllers\Umum;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Storage;
use App\Models\Cart;
use App\Models\Kategori;
use App\Models\Produk;
class KategoriController extends Controller
{

    public function index($slug)
    {
        $kategori = Kategori::where('parent_id', null)->where('slug', $slug)->first();
        $id = Kategori::defaultOrder()->descendantsOf($kategori->id)->pluck('id')->toArray();
        $kategori_data = Kategori::defaultOrder()->descendantsOf($kategori->id);

        $produk = Produk::whereIn('kategori_id', $id)->orderBy('updated_at', 'DESC')->get();

        return view('umum.kategori.utama', compact('kategori', 'produk', 'kategori_data'));
    }


    public function sub_kategori_json(Request $request)
    {
        $kategori = Kategori::where('parent_id', $request->category_id)->orderBy('nama', 'ASC')->get();
        return response()->json($kategori);
    }

    public function cartTop_data()
    {
        $data = collect([]);
        if(auth()->guard('web')->check())
        {
            $user = auth()->guard('web')->user()->id;
            $data->cart = Cart::where('user_id', $user)->orderBy('updated_at', 'DESC')->limit(10)->get();
            $data->status = true;
        }else{
            $data->status = false;
        }
        // dd($data->cart->count());
        return response()->json([
            'fail' => false,
            'html' => view('umum.cart.include.top_cart', compact('data'))->render(),
        ]);
    }
}
