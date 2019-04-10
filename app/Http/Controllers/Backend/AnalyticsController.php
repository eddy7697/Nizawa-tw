<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Analytics;
use Spatie\Analytics\Period;

class AnalyticsController extends Controller
{
    public function getPageViews($days)
    {
        $analyticsData = Analytics::fetchMostVisitedPages(Period::days($days));

        return $analyticsData;
    }

    public function getUserType($days)
    {
        $analyticsData = Analytics::fetchUserTypes(Period::days($days));

        return $analyticsData;
    }
}
