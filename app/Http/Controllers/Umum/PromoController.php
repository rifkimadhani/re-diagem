<?php

namespace App\Http\Controllers\Umum;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Storage;
use App\Models\Promo;
class PromoController extends Controller
{

    public function index()
    {
        $promo = Promo::where('is_active', 1)->orderBy('updated_at', 'DESC')->get();

        return view('umum.promo.index', compact('promo'));
    }


    public function detail($slug)
    {
        $promo = Promo::where('slug', $slug)->first();

        return view('umum.promo.detail', compact('promo'));
    }
}
