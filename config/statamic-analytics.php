<?php

return [


    /**
     * Do you want to use the cache?
     * True of False.
     */
    'cache_enabled' => env('STATAMIC_ANALYTICS_CACHE', true),

    /**
     * Cache duration
     */
    'cache_duration' => 20000,

    /**
     * Default Time Period
     * Options: today, 1_week, 30_days, 6_months, 12_months,
     */
    'default_period' => '1_week',


    'exclude' => [
        '/analytics',
        'img/*',
        'vendor/*',
        'css/*',
        'js/*',
    ],

];
