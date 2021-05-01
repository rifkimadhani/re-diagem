<?php

namespace App\Widgets\Umum;

use Arrilot\Widgets\AbstractWidget;

class SellerHeader extends AbstractWidget
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

        return view('widgets.umum.seller_header', [
            'config' => $this->config,
        ]);
    }
}
