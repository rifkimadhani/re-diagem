<?php

namespace App\Widgets\Umum;

use App\Models\Bisnis;
use Arrilot\Widgets\AbstractWidget;

class SellerBox extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $toko = Bisnis::latest()->get();
        return view('widgets.umum.seller_box', compact('toko'));
    }
}
