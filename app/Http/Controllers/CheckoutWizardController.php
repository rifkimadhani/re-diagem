<?php

namespace App\Http\Controllers;

use App\Steps\Checkout\AturStep;
use App\Steps\Checkout\BayarStep;
use Ycs77\LaravelWizard\Wizardable;

class CheckoutWizardController extends Controller
{
    use Wizardable;

    /**
     * The wizard name.
     *
     * @var string
     */
    protected $wizardName = 'checkout';

    /**
     * The wizard title.
     *
     * @var string
     */
    protected $wizardTitle = 'Checkout';

    /**
     * The wizard options.
     *
     * @var array
     */
    protected $wizardOptions = [];

    /**
     * The wizard steps instance.
     *
     * @var array
     */
    protected $steps = [
        AturStep::class,
        BayarStep::class,
    ];
}
