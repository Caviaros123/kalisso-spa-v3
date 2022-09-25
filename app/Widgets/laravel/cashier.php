<?php

namespace App\Widgets\laravel;

use Arrilot\Widgets\AbstractWidget;

class cashier extends AbstractWidget
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

        return view('widgets.laravel.cashier', [
            'config' => $this->config,
        ]);
    }
}
