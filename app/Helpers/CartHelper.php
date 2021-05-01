<?php
use App\Models\Cart;
if (!function_exists('get_totalCart')) {

    /**
     * Mendapatkan Total Keranjang Belanja Pengguna
     *
     * @param
     * @return
     */
    function get_totalCart()
    {
        if(auth()->guard('web')->check())
        {
            $user = auth()->guard('web')->user()->id;
            $cart = Cart::where('user_id', $user)->get()->sum('qty');
            return $cart;
        }else{
            return 0;
        }
    }
}

if (!function_exists('get_cartContent')) {

    /**
     * Mendapatkan Total Keranjang Belanja Pengguna
     *
     * @param
     * @return
     */
    function get_cartContent()
    {
        $user = auth()->guard('web')->user()->id;
        $cart = Cart::where('user_id', $user)->orderBy('updated_at', 'DESC')->limit(4)->get();
        return $cart;
    }
}


if (!function_exists('get_cart_id')) {

    /**
     * Mendapatkan Total Keranjang Belanja Pengguna
     *
     * @param
     * cart = array data
     * @return
     */
}
