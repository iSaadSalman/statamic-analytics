<?php

namespace ISaadSalman\StatamicAnalytics\Http\Controllers\Api;

use Illuminate\Http\Request;
use ISaadSalman\StatamicAnalytics\Http\Traits\FetchResultsTrait;
use Statamic\Http\Controllers\CP\CpController;

use ISaadSalman\StatamicAnalytics\Models\PageView;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AggregatesController extends CpController
{
    use FetchResultsTrait;

    public function fetch(Request $request)
    {   


        $aggregates = $this->getAggregates();

        return $aggregates;


        // return [
        //     'unique_users'=> [
        //         'value' => '12',
        //     ],
        //     'page_views'=> [
        //         'value' => '12',
        //     ],'bounce_rate'=> [
        //         'value' => '12',
        //     ],'visit_duration'=> [
        //         'value' => '20',
        //     ]
        // ];
    
    }

    protected function getAggregates(): array
    {


        return [
            'unique_users' => [
                'value' => PageView::query()
                    ->scopes(['filter' => [request()->get('period')]])
                    ->select('session')
                    ->groupBy('session')
                    ->get()
                    ->count(),
            ],
            'page_views' => [
                'value' => PageView::query()
                    ->scopes(['filter' => [request()->get('period')]])
                    ->count(),
            ],
            // 'bounce_rate'=> [
            //     'value' => '12',
            // ],'visit_duration'=> [
            //     'value' => '20',
            // ]
        ];
    }
}
