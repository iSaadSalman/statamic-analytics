<?php

namespace ISaadSalman\StatamicAnalytics\Http\Controllers\Api;

use Illuminate\Http\Request;
use ISaadSalman\StatamicAnalytics\Http\Traits\FetchResultsTrait;
use Statamic\Http\Controllers\CP\CpController;

use ISaadSalman\StatamicAnalytics\Models\PageView;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TopReferrersController extends CpController
{
    // use FetchResultsTrait;

    public function fetch(Request $request)
    {


        $topRef = $this->topReferrers();

        return $topRef;


        // return [
        //     '0'=> [
        //         'source' => 'Chrome',
        //         'visitors' => '2',
        //     ],
        //     '1'=> [
        //         'source' => 'Chrome',
        //         'visitors' => '2',
        //     ],
        //     '2'=> [
        //         'source' => 'Chrome',
        //         'visitors' => '2',
        //     ]
        // ];
    }

    protected function topReferrers(): Collection
    {
        return PageView::query()
            ->scopes(['filter' => [request()->get('period')]])
            ->select('source', DB::raw('count(*) as visitors'))
            ->whereNotNull('source')
            ->groupBy('source')
            ->get();
    }
}
