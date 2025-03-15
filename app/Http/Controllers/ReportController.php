<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Jobs\GenerateReportJob;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function create() {
        return view('reports.create');
    }
    public function store(ReportRequest $request) {
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        GenerateReportJob::dispatch($startDate, $endDate);

        return redirect()->route('foods.index');
    }
}
