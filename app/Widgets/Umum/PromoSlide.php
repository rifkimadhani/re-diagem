<?php

namespace App\Widgets\Umum;

use Arrilot\Widgets\AbstractWidget;
use App\Models\Promo;
class PromoSlide extends AbstractWidget
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
        $promo = Promo::where('is_active', 1)->where('is_featured', 1)->orderBy('updated_at', 'DESC')->limit(8)->get();
        return view('widgets.umum.promo_slide', compact('promo'));
    }
}
