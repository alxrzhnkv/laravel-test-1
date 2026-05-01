@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="bread">
        <a href="/">Главная</a>
    </div>

    <h1>Список продуктов</h1>

    @include('products.partials._filters')

    <div class="products">
        @foreach ($products as $product)
            <div class="product">
                <h3>{{ $product->name }} </h3>
                <p>Категория: {{ $product->category->name ?? 'Без категории' }}</p>
                <p>Цена: {{ $product->price }}</p>
                <p>Рейтинг: {{ $product->rating }}</p>
            </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $products->links() }}
    </div>
@endsection
