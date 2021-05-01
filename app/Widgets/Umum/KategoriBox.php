<?php

namespace App\Widgets\Umum;

use Arrilot\Widgets\AbstractWidget;

class KategoriBox extends AbstractWidget
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

        return view('widgets.umum.kategori_box', [
            'config' => $this->config,
        ]);
    }
}
