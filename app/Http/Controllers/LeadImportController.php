<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\LeadsImport;
use Maatwebsite\Excel\Facades\Excel;

class LeadImportController extends Controller
{
    public function create()
    {
        return view('leads.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:5120',
        ]);

        Excel::import(new LeadsImport, $request->file('file'));

        return redirect()->back()->with('success', 'Leads imported successfully.');
    }
}
