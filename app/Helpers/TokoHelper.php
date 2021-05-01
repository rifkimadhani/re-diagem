<?php

if (!function_exists('get_toko_img')) {
    /**
     * Mengambil Logo Toko
     *
     * @param
     * $img_path = Path Image
     * @return
     * URL PATH Image
     */
    function get_toko_img($img_path)
    {
        $isExists = Storage::disk('umum')->exists($img_path);
        if(!$isExists)
        {
            return asset('assets/img/placeholder/toko.png');
        }else{
            return asset('uploads/'.$img_path);
        }

    }
}


if (!function_exists('get_toko_sampul')) {
    /**
     * Mengambil Logo Toko
     *
     * @param
     * $img_path = Path Image
     * @return
     * URL PATH Image
     */
    function get_toko_sampul($img_path)
    {
        $isExists = Storage::disk('umum')->exists($img_path);
        if(!$isExists)
        {
            return asset('assets/img/placeholder/sampul.png');
        }else{
            return asset('uploads/'.$img_path);
        }

    }
}
