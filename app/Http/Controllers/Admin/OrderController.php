<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderDetail;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Only Authenticated users for "mitra" guard
     * are allowed.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show Riwayat Penjualan.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if ($request->ajax()) {

            $status = $request->status;
            $data = Order::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                if($row->status == 'dipesan')
                {
                    return '<span class="badge badge-warning">Pending</span>';
                }else if($row->status == 'konfirmasi'){
                    return '<span class="badge badge-info">Diproses</span>';
                }else if($row->status == 'dikirim')
                {
                    return '<span class="badge badge-info">Dikirim</span>';
                }else if($row->status == 'selesai')
                {
                    return '<span class="badge badge-primary">Selesai</span>';
                }else if($row->status == 'batal')
                {
                    return '<span class="badge badge-danger">Selesai</span>';
                }
            })
            ->addColumn('produk', function($row){
                return $row->detail->count();
            })
            ->addColumn('customer', function($row){
                return $row->customer->nama;
            })
            ->addColumn('aksi', function($row){
                    $btn = '<center><a href="'. route('admin.produk.edit', $row->id) .'" class="btn btn-secondary btn-sm mr-5"><i class="si si-note"></i></a>';
                    $btn .= '<button type="button" onClick="hapus(\''.$row->id.'\')" class="btn btn-secondary btn-sm"><i class="si si-trash"></i></button></center>';
                    return $btn;
            })
            ->rawColumns(['status', 'customer', 'views', 'stok', 'aksi'])
            ->make(true);
        }
        return view('admin.order.index');
    }
}
