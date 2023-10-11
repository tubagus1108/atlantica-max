@extends('layouts.app')

@section('content')
    <div class="nk-header-title nk-header-title-lg nk-header-title-parallax nk-header-title-parallax-opacity">
        <div class="bg-image">
            <img src="{{ asset('assets/images/image-1.png') }}" alt="" class="jarallax-img">
        </div>
        <div class="nk-header-table">
            <div class="nk-header-table-cell">
                <div class="container">
                    {{-- {{session('user')}} --}}
                    <div class="nk-header-text">
                        <h1 class="nk-title display-3">Atlantica Max Supreme</h1>
                        <div class="nk-gap-2"></div>

                        @if (session()->has('user'))
                            {{-- <a class="nk-btn nk-btn-lg nk-btn-color-main-1 link-effect-4" href="{{ route('download') }}"> --}}
                            <a class="nk-btn nk-btn-lg nk-btn-color-main-1 link-effect-4" href="">
                                <span>Download the game</span>
                            </a>
                        @else
                            <a class="nk-btn nk-btn-lg nk-btn-color-main-1 link-effect-4"
                                href="{{ route('register.index') }}">
                                <span>{{ __('home.join') }}</span>
                            </a>
                        @endif

                        <div class="nk-gap-4"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
