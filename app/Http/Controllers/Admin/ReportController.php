<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function create(Request $request)
    {
        $report = new Report();
        $report->created_by = Auth::id();
        $report->station_id = $request->post("station_id");
        $report->description = $request->post("description");
        $report->created_at = Carbon::now();
        $report->save();
    }

    public function get($id)
    {
        return Report::find($id);
    }

    public function getAll()
    {
        return Report::all();
    }
}
