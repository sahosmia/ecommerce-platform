@extends('layouts.admin')

@section('title', 'Dashboard')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Admin Dashboard
</h2>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-semibold text-gray-800">Total Products</h3>
            <p class="text-3xl font-bold mt-2">{{ $stats['products'] }}</p>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-semibold text-gray-800">Trashed Products</h3>
            <p class="text-3xl font-bold mt-2">{{ $stats['trashed_products'] }}</p>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-semibold text-gray-800">Total Categories</h3>
            <p class="text-3xl font-bold mt-2">{{ $stats['categories'] }}</p>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-semibold text-gray-800">Trashed Categories</h3>
            <p class="text-3xl font-bold mt-2">{{ $stats['trashed_categories'] }}</p>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-semibold text-gray-800">Total Subcategories</h3>
            <p class="text-3xl font-bold mt-2">{{ $stats['subcategories'] }}</p>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-semibold text-gray-800">Trashed Subcategories</h3>
            <p class="text-3xl font-bold mt-2">{{ $stats['trashed_subcategories'] }}</p>
        </div>
    </div>

</div>
@endsection