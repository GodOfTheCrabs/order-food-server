<?php

namespace App\Http\Controllers\Api;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\HistoryOrderResourse;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrdersAnalyticsResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OrderController extends Controller
{

    public function __construct(
        protected OrderService $orderService
    )
    {
    }

    public function store(OrderRequest $request)
    {
        $validated = $request->validated();

        $order = Order::create([
            'user_id' => $validated['user_id'],
            'foods' => $validated['foods'],
            'total_price' => $validated['total_price'],
            'track_order' => $validated['track_order'],
            'preparation_time' => $validated['preparation_time'],
            'delivery_time' => $validated['delivery_time'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Заказ успешно создан!',
        ], 201);
    }

    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $orders = Order::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return new OrderCollection($orders);
    }

    public function getOrders(SearchRequest $request)
    {
        $filters = $request->validated();

        $userId = $request->user()->id;
        $orders = $this->orderService->getOrders($userId, $filters);

        return HistoryOrderResourse::collection($orders);
    }

    public function getAnalytics(SearchRequest $request)
    {
        $filters = $request->validated();

        $userId = $request->user()->id;
        $analyticsData = $this->orderService->getAnalytics($userId, $filters);

        return new OrdersAnalyticsResource($analyticsData);
    }

    public function export(SearchRequest $request)
    {
        $filters = $request->validated();
        $type = $filters['report_type'] ?? 'detailed';

        $userId = $request->user()->id;
        $orders = $this->orderService->getExportOrders($userId, $filters);

        $fileName = 'orders_' . now()->format('Ymd_His') . '.xlsx';

        Excel::store(new OrdersExport($orders, $type), "reports/{$fileName}", 'public');

        return response()->download(storage_path("app/public/reports/{$fileName}"));
    }
}
