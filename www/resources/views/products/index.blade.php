@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="bread">
        <a href="/">Главная</a>
    </div>

    <h1>Список продуктов</h1>

    @include('products.partials._filters')

    <div id="products-container" class="products"></div>
    <div id="pagination-container" class="pagination"></div>
@endsection
