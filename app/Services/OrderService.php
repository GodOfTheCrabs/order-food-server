<?php

namespace App\Services;

use App\Filters\BaseFilter;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Support\Arr;

class OrderService
{
    public function __construct(
        protected BaseFilter $filters
    ) {}
    public function getOrders($userId, $filters)
    {
        $query = Order::where('user_id', $userId);

        $perPage = $filters['per_page'] ?? 10;

        $query = $this->filters->apply($query, $filters);

        return $query->paginate($perPage);
    }

    public function getExportOrders($userId, $filters)
    {
        $query = Order::where('user_id', $userId);
        $query = $this->filters->apply($query, $filters);
        return $query->get();
    }
    public function getAnalytics($userId, $filters)
    {
        $ordersQuery = Order::where('user_id', $userId);
        $ordersQuery = $this->filters->apply($ordersQuery, $filters);

        $orders = $ordersQuery->select('foods')->get();

        $foodItems = [];
        $orderSums = []; // Для підрахунку total по кожному замовленню

        foreach ($orders as $order) {
            $orderTotal = 0;

            foreach ($order->foods as $item) {
                $foodItems[] = [
                    'food_id' => $item['food_id'],
                    'count' => $item['count'],
                ];

                // Підсумок для поточного замовлення
                $food = Food::find($item['food_id']);
                if ($food) {
                    $orderTotal += $food->price * $item['count'];
                }
            }

            $orderSums[] = $orderTotal;
        }

        // Сума по кожній food_id
        $foodCounts = collect($foodItems)
            ->groupBy('food_id')
            ->map(fn($items) => collect($items)->sum('count'));

        // Витягуємо продукти з категоріями
        $foods = Food::whereIn('id', $foodCounts->keys())->with('category')->get();

        $categoryTotals = [];
        $totalSpent = 0;

        foreach ($foods as $food) {
            $count = $foodCounts[$food->id];
            $sum = $food->price * $count;

            $categoryName = $food->category->name;

            if (!isset($categoryTotals[$categoryName])) {
                $categoryTotals[$categoryName] = 0;
            }

            $categoryTotals[$categoryName] += $sum;
            $totalSpent += $sum;
        }

        $result = [];

        foreach ($categoryTotals as $category => $sum) {
            $result[] = [
                'category' => $category,
                'sum' => round($sum, 2),
                'percent' => round($sum / $totalSpent * 100, 1)
            ];
        }

        return [
            'total_spent' => round($totalSpent, 2),
            'categories' => $result,
            'max' => round(max($orderSums), 2),
            'min' => round(min($orderSums), 2),
            'average' => round(collect($orderSums)->avg(), 2),
        ];
    }


}
