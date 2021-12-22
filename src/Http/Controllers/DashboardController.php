<?php

namespace ISaadSalman\StatamicAnalytics\Http\Controllers;

use Statamic\Http\Controllers\CP\CpController;

class DashboardController extends CpController
{
    public function index()
    {

        return view('statamic-analytics::dashboard', [
            'title' => 'Analytics'
        ]);
    }
}
