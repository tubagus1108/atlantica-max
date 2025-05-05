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
                    <h1 class="nk-title">Item Mall</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="item-container">

        <div class="header-container">
            <div class="header-cuadro">
                <h2>GENERAL STORE</h2>
            </div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @elseif(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <div class="items-list clearfix">
            @foreach ($data as $product)
            <div class="item-box product" data-productno="{{ $product->itemid }}">
                <div class="tag sale en"></div>
                <div class="item-info">
                    <div class="item-img">
                    <p>{{ $product->name }}</p>
                    <a>
                        <img src="{{ asset('assets/images/itemmall/img_shop/' . $product->name . $product->image) }}"
                            alt="{{ $product->name }}">
                    </a>
                    </div>
                    <div class="item-desc">
                        <p class="sale-price">
                            <span class="regular-price"></span><span class="sale">{{ $product->price }}</span>
                            Cash
                        </p>
                    </div>
                </div>
                <form action="{{ route('purchase') }}" method="post">@csrf
                    <input type="hidden" name="product_id" value="{{ $product->itemid }}">
                    <input type="hidden" name="product_price" value="{{ $product->price }}">
                    <label for="quantity"></label>
                    <select name="quantity" id="quantity">
                        <option value="1">1</option>
                        <option value="10">10</option>
                        <option value="100">100</option>
                        <option value="1000">1000</option>
                    </select>
                    <button type="submit" class="buy-btn">Buy</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".product").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endsection
