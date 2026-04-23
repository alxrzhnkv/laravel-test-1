@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <a href="{{ route('products.index') }}">Перейти к продуктам</a>
@endsection
