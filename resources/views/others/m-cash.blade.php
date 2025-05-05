@extends('layouts.app')
@section('content')
    <!-- Header Title -->
    <div class="nk-header-title nk-header-title-sm nk-header-title-parallax nk-header-title-parallax-opacity">
        <div class="bg-image">
            <img src="{{ asset('assets/images/image-1.png') }}" alt="" class="jarallax-img">
        </div>
        <div class="nk-header-table">
            <div class="nk-header-table-cell">
                <div class="container">
                    <h1 class="nk-title">M CASH</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="item-container">

        @if (session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @elseif(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <div class="items-list clearfix">
            @foreach ($data as $product)

            @endforeach
        </div>
    </div>
@endsection
