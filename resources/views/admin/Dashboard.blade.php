@extends('layouts.admin')

@section('title', 'Dashboard')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Admin Dashboard
</h2>
@endsection

@section('content')
<div class="py-12 bg-blue-900">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class=" overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                Welcome back! You're logged in.
            </div>
        </div>
    </div>
</div>
@endsection