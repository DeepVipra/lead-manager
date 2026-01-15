<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $fromDate = $request->from_date;
        $toDate   = $request->to_date;

        $baseQuery = Lead::query();

        // Apply date range filter if provided
        if ($fromDate && $toDate) {
            $baseQuery->whereBetween('lead_date', [$fromDate, $toDate]);
        }

        // 1. Total Leads
        $totalLeads = (clone $baseQuery)->count();

        // 2. Country-wise Leads
        $countryCounts = (clone $baseQuery)
            ->selectRaw('country, COUNT(*) as total')
            ->groupBy('country')
            ->orderByDesc('total')
            ->get();

        // 3. Service-wise Leads
        $serviceCounts = (clone $baseQuery)
            ->selectRaw('service, COUNT(*) as total')
            ->groupBy('service')
            ->orderByDesc('total')
            ->get();

        return view('dashboard', compact(
            'totalLeads',
            'countryCounts',
            'serviceCounts',
            'fromDate',
            'toDate'
        ));
    }
}
