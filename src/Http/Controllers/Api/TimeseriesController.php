<?php

namespace ISaadSalman\StatamicAnalytics\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use ISaadSalman\StatamicAnalytics\Http\Traits\FetchResultsTrait;
use Statamic\Http\Controllers\CP\CpController;

use ISaadSalman\StatamicAnalytics\Models\PageView;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use \Carbon\CarbonPeriod;

class TimeseriesController extends CpController
{
    use FetchResultsTrait;

    public function __construct()
    {

    }

    public function fetch(Request $request)
    {   

        $timeSeries =  $this->getTimeSeries();
        return $timeSeries;
    }

    public function getTimeSeries() {

        $range =  $this->generateLabels(true);
        
        return [
            'labels'=> $range,
            'series'=> $this->getData( $this->generateLabels() ),
        ];
    }

    public function getData($range) {
        // return [25, 40, 30, 35, 8, 20, 17, -4];

        $allData =  PageView::query()
            // ->select('created_at', DB::raw('count(*) as visitors'))
            ->whereBetween('created_at', [$range[0], $range[ count($range) - 1 ]])
            // ->groupBy('created_at')
            ->get();
            // ->map( function($item) {
            //     return $item->visitors;
            // });
        
        $data = [];
        foreach ($range as $key => $date) {

            $nextDate = isset($range[$key + 1]) ? $range[$key + 1] : now();

            $count = $allData
                        ->whereBetween('created_at', [$date,  $nextDate])
                        // ->where('created_at', '>', $date)
                        // ->where('created_at', '<' , $nextDate )
                        ->count();
            $data[] =  $count;


        }

        return $data;
     
    }

    public function generateLabels ($formated = false) {

        $period = request()->get('period');
        $endDate = now()->timezone('Asia/Riyadh');
        $segregate =  '1 day';
        $format = '';

        switch ( $period ) {
            case 'today':
                $startDate = $endDate->copy()->startOfDay();
                $segregate =  '1 hour';
                $format = 'h:i';
                break;
            case '1_week':
                $startDate = $endDate->copy()->subDays(7);
                $segregate =  '1 day';
                $format = 'M-d';
                break;
            case '30_days':
                $startDate = $endDate->copy()->subDays(30);
                $segregate =  '3 day';
                $format = 'M-d';
                break;
            case '6_months':
                $startDate = $endDate->copy()->subMonth(6);
                $segregate =  '1 month';
                $format = 'M';
                break;
            case '12_months':
                $startDate = $endDate->copy()->subMonth(12);
                $segregate =  '1 month';
                $format = 'M';
                break;
            default:
                # code...
                break;
        }

        $periodRange = CarbonPeriod::create($startDate, $segregate , $endDate);

        if ($formated) {
            $formatedRange = [];
            foreach ($periodRange->toArray() as $key => $date) {
                $formatedRange[] = $date->format($format);
            }
            return $formatedRange;
        }
   
        // Convert the period to an array of dates
        return $periodRange->toArray();

    }
}
