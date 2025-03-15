<?php

namespace App\Jobs;

use App\Events\ReportGenerated;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Storage;

class GenerateReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $startDate;
    public $endDate;
    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        $orders = Order::whereBetween('created_at', [$this->startDate, $this->endDate])
            ->get();
        $totalSum = $orders->sum('total_price');

        $pdf = Pdf::loadView('reports.orders', compact('orders', 'totalSum'));

        $pdfPath = 'reports/orders_report.pdf'; 
    
        Storage::put($pdfPath, $pdf->output());


        event(new ReportGenerated($pdfPath));
    }

}
