@extends('layouts.main')
@section('content')
@vite('resources/css/showOrder.css')
<div class="container">
    <div class="col-md-12 col-lg-12">
        <div class="basket-product-block">
            @foreach ($foods as $food)
                <div class="product-block">
                    <div>
                        <img src="{{ asset("storage/$food->image") }}"class="img-product">
                        <h6>{{ $food->name }}</h6>
                    </div>
                    <div>
                        <p> {{$food->count }} шт.</p>
                    </div>
                    <div>
                        <p> Категорія: {{$food->category->name }}</p>
                    </div>
                    <div class="product-price">
                        <p class="price-all">{{$food->count * $food->price }} грн</p>
                        <p class="price-one">{{ $food->price }} грн за шт.</p>
                    </div>

                </div>    
            @endforeach

            <div class="mt-4">
                <h5><strong>Дата заказа:</strong> {{ Carbon\Carbon::parse($order->created_at)->format('d.m.Y H:i') }}</h5>
                <h5><strong>Общая сумма заказа:</strong> {{ $order->total_price }} грн</h5>
                <h5><strong>Замовник:</strong> {{ $order->user->email }}</h5>
            </div>
        </div>
    </div>
</div>

@endsection