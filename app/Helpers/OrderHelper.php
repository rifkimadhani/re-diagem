<?php
use Carbon\Carbon;
if (!function_exists('getInvoice')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function getInvoice()
    {
        return 'INV'.Carbon::now()->format('Ymd').mt_rand(10000, 99999);
    }
}
