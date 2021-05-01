<?php

namespace App\Http\Controllers\Umum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Order;
class UserController extends Controller
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
    public function index()
    {

        return view('umum.user.index');
    }

    public function profil()
    {

        return view('umum.user.profil');
    }

    public function pesanan()
    {
        $order = Order::where('user_id', auth()->guard('web')->user()->nama)->where('bayar_status', 'unpaid')->orderBy('tgl_transkasi', 'DESC')->get();


        return view('umum.user.pesanan', compact('order'));
    }

    public function pembayaran()
    {

        return view('umum.user.pembayaran');
    }
}
