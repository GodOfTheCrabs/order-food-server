<?php

namespace App\Exports;

use App\Models\Food;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    protected Collection $orders;
    protected string $type;

    public function __construct(Collection $orders, string $type)
    {
        $this->orders = $orders;
        $this->type = $type;
    }

    public function collection()
    {
        if ($this->type === 'summary') {
            return $this->orders->map(function ($order) {
                return [
                    'Замовлення #' . $order->id,
                    $order->created_at->format('Y-m-d'),
                    $order->total_price,
                ];
            });
        }

        // Варіант "детальний"
        $rows = collect();

        foreach ($this->orders as $order) {
            // Основний рядок замовлення
            $rows->push([
                $order->id,
                $order->created_at->format('Y-m-d'),
                $order->total_price,
                '', '', '', '', ''
            ]);

            // Деталі страв
            foreach ($order->foods as $item) {
                $food = Food::with('category')->find($item['food_id']);
                if (!$food) continue;

                $count = $item['count'];
                $price = $food->price;
                $total = $count * $price;

                $rows->push([
                    '', '', '',
                    $food->name,
                    $food->category->name ?? '',
                    $count,
                    $price,
                    $total
                ]);
            }
        }

        return $rows;
    }

    public function headings(): array
    {
        if ($this->type === 'summary') {
            return [
                '№ Замовлення',
                'Дата',
                'Загальна Сума',
            ];
        }

        return [
            '№ Замовлення',
            'Дата',
            'Сума',
            'Страва',
            'Категорія',
            'Кількість',
            'Ціна за Одиницю',
            'Разом',
        ];
    }
}
