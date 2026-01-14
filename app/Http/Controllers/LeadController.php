<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->search . '%')
                  ->orWhere('client_name', 'like', '%' . $request->search . '%')
                  ->orWhere('website', 'like', '%' . $request->search . '%');
            });
        }

        // Filters
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        if ($request->filled('service')) {
            $query->where('service', $request->service);
        }

        if ($request->filled('reply')) {
            $query->where('reply', $request->reply);
        }

        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('lead_date', [
                $request->from_date,
                $request->to_date,
            ]);
        }

        $leads = $query->latest()->paginate(15)->withQueryString();

        return view('leads.index', compact('leads'));
    }
}
