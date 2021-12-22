<?php

namespace ISaadSalman\StatamicAnalytics\Http\Controllers\Api;

use Illuminate\Http\Request;
use ISaadSalman\StatamicAnalytics\Http\Traits\FetchResultsTrait;
use Statamic\Http\Controllers\CP\CpController;
use ISaadSalman\StatamicAnalytics\Models\PageView;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;



class TopBrowsersController extends CpController
{
    use FetchResultsTrait;

    public function fetch(Request $request)
    {

        $topBrowsers =  $this->getBrowsers();

        return $topBrowsers;

        // return  [
        //     '0'=> [
        //         'browser' => 'Chrome',
        //         'visitors' => '12',
        //     ],
        //     '1'=> [
        //         'browser' => 'Chrome',
        //         'visitors' => '12',
        //     ]
        // ];
    }

    protected function getBrowsers(): Collection
    {
        return PageView::query()
            ->scopes(['filter' => [request()->get('period')]])
            ->select('browser', DB::raw('count(*) as visitors'))
            ->groupBy('browser')
            ->get();
    }
}
