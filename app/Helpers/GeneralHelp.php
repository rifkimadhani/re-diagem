<?php
use Carbon\Carbon;
use Session as Session;
use Storage as Storage;
use App\Models\Kategori;
if (!function_exists('getStokPerVariasi')) {

    /**
     * Mengambil Stok Terkini Berdasarkan Variasi Produk
     *
     * @param
     * $variasi_id = ID Variasi
     * @return
     * Jumlah Stok Variasi
     */
    function getStokPerVariasi($variasi_id)
    {
        $variasi = VariasiDetail::where('variasi_id',$variasi_id)->first();
        if($variasi)
        {
            return $variasi->qty_tersedia;
        }else{
            return 0;
        }
    }
}

if (!function_exists('get_produk_img')) {

    /**
     * Mengambil Stok Terkini Berdasarkan Variasi Produk
     *
     * @param
     * $variasi_id = ID Variasi
     * @return
     * Jumlah Stok Variasi
     */
    function get_produk_img($img_path)
    {
        $isExists = Storage::disk('umum')->exists($img_path);
        if(!$isExists)
        {
            return asset('public/img/placeholder/product.png');
        }else{
            return asset('public/uploads/'.$img_path);
        }

    }
}

if (!function_exists('get_variant')) {

    /**
     * Mengambil Stok Terkini Berdasarkan Variasi Produk
     *
     * @param
     * $variant = Nilai Variasi
     * @return
     * Jumlah Stok Variasi
     */
    function get_variant($variant, $var = 1)
    {
        if(strpos($variant, '-') !== false ) {
            list($var1, $var2) = explode('-', $variant);
            if($var == 2)
            {
                return $var2;
            }else{
                return $var1;
            }
       }else{
        return $variant;
       }
    }
}

if (!function_exists('kategori_menu')) {

    /**
     * Mengambil Stok Terkini Berdasarkan Variasi Produk
     *
     * @param
     * $variasi_id = ID Variasi
     * @return
     * Jumlah Stok Variasi
     */
    function kategori_menu()
    {
        $kategori = Kategori::where('parent_id', null)->orderBy('nama', 'ASC')->get();
        return $kategori;
    }
}

if (!function_exists('getCartCount')) {

    /**
     * Mengambil Stok Terkini Berdasarkan Variasi Produk
     *
     * @param
     * $variasi_id = ID Variasi
     * @return
     * Jumlah Stok Variasi
     */
    function getCartCount($tipe)
    {
        if($tipe == 'pembelian')
        {
            $cart = \Cart::session(Session::get('bisnis.outlet_id').'-pembelian')->getContent();
        }else if($tipe == 'penjualan'){
            $cart = \Cart::session(Session::get('bisnis.outlet_id').'-penjualan')->getContent();
        }else if($tipe == 'returbeli'){
            $cart = \Cart::session(Session::get('bisnis.outlet_id').'-returbeli')->getContent();
        }
        return $cart->count();
    }
}

if (!function_exists('getCart')) {

    /**
     * Mengambil Data Cart
     *
     * @param
     * $tipe = Tipe transaksi penjualan/pembelian
     * @return
     * Session Cart
     */
    function getCart($tipe)
    {
        if($tipe == 'pembelian')
        {
            $cart = \Cart::session(Session::get('bisnis.outlet_id').'-pembelian');
        }else if($tipe == 'penjualan'){
            $cart = \Cart::session(Session::get('bisnis.outlet_id').'-penjualan');
        }else if($tipe == 'returbeli'){
            $cart = \Cart::session(Session::get('bisnis.outlet_id').'-returbeli');
        }
        return $cart;
    }
}

if (!function_exists('uf_date')) {

    /**
     * Konversi tanggal kedalam format MYSQL
     *
     * @param string $date
     * @param bool $time (default = false)
     * @return strin
     */
    function uf_date($date, $time = false)
    {
        $date_format = 'd-m-Y';
        $mysql_format = 'Y-m-d';
        if ($time) {
            $date_format = $date_format . ' H:i';

            $mysql_format = 'Y-m-d H:i:s';
        }

        return Carbon::createFromFormat($date_format, $date)->format($mysql_format);
    }
}

if (!function_exists('currency_frm')) {

    /**
     * Konversi Ke Rupiah Currency
     *
     * @param string $date
     * @param bool $time (default = false)
     * @return strin
     */
    function currency_frm($value)
    {
        return "Rp".number_format($value,0,',','.');
    }
}

