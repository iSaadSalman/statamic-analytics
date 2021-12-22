<?php

namespace ISaadSalman\StatamicAnalytics\Http\Controllers\Api;

use Illuminate\Http\Request;
use ISaadSalman\StatamicAnalytics\Http\Traits\FetchResultsTrait;
use Statamic\Http\Controllers\CP\CpController;

use ISaadSalman\StatamicAnalytics\Models\PageView;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class TopCountriesController extends CpController
{
    use FetchResultsTrait;

    public function fetch(Request $request)
    {

        $topCountries =  $this->topCountries();

        return $topCountries;

        // return  [
        //     '0'=> [
        //         'country' => 'Chrome',
        //         'visitors' => '12',
        //     ],
        //     '1'=> [
        //         'country' => 'Chrome',
        //         'visitors' => '12',
        //     ]
        // ];
    }

   
    protected function topCountries(): Collection
    {
        return PageView::query()
            ->scopes(['filter' => [request()->get('period')]])
            ->select('country', DB::raw('count(*) as visitors'))
            ->groupBy('country')
            ->get();
    }
}
