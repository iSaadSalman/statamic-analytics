<?php

namespace ISaadSalman\StatamicAnalytics\Http\Controllers\Api;

use Illuminate\Http\Request;
use ISaadSalman\StatamicAnalytics\Http\Traits\FetchResultsTrait;
use Statamic\Http\Controllers\CP\CpController;

use ISaadSalman\StatamicAnalytics\Models\PageView;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class TopPagesController extends CpController
{
    use FetchResultsTrait;

    public function fetch(Request $request)
    {

        $topPages = $this->getPages();
        return $topPages;

        // return [
        //     '0'=> [
        //         'page' => 'Chrome',
        //         'visitors' => '12',
        //     ],
        //     '1'=> [
        //         'page' => 'Chrome',
        //         'visitors' => '12',
        //     ]
        // ];
    }


    protected function getPages(): Collection
    {
        return PageView::query()
            ->scopes(['filter' => [request()->get('period')]])
            ->select('uri as page', DB::raw('count(*) as visitors'))
            ->groupBy('page')
            ->get();
    }
}
