<?php

namespace App\Http\Controllers\Umum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Order;
use App\Models\OrderDetail;
class OrderController extends Controller
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

    public function index()
     {
        // $user_id = auth()->guard('web')->user()->id;

        $induk = Order::where('order.user_id', auth()->guard('web')->user()->id)->where('bayar_status', 'paid')->pluck('id');
        $order = OrderDetail::whereIn('order_id', $induk)->with('bisnis:id,nama',)->orderBy('updated_at', 'DESC')->get();
        $order = $order->groupBy(function ($bisnis) {
            return $bisnis->bisnis_id.','.$bisnis->bisnis->nama.','.$bisnis->order->tgl_transaksi.','.$bisnis->order->status;
        })->all();

        return view('umum.user.pesanan', compact('order'));
     }


     public function belum_bayar()
     {
        $order = Order::where('order.user_id', auth()->guard('web')->user()->id)->where('bayar_status', 'unpaid')->get();
        // $order = OrderDetail::whereIn('order_id', $induk)->orderBy('updated_at', 'DESC')->get();
        
         return view('umum.user.belum_bayar', compact('order'));
     }


    public function invoice($invoice_no)
    {
        $order = Order::where('order.user_id', auth()->guard('web')->user()->id)->where('invoice_no', $invoice_no)->first();
        return view('umum.user.invoice', compact('order'));
    }

}
