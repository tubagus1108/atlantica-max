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

        {{-- <div id="item-mall-nav-wrap"> --}}
        {{-- <ul id="item-mall-nav">
                <li class="add-divider"><a href="{{ url('consumables') }}">Consumables</a></li>
                <li class="add-divider"><a href="{{ url('mounts') }}">Mounts</a></li>
                <li class="add-divider"><a href="{{ url('boxes') }}">Boxes</a></li>
                <li class="add-divider"><a href="{{ url('decorations') }}">Decorations</a></li>
                <li class="add-divider"><a href="{{ url('cards') }}">Cards</a></li>
                <li><a href="{{ url('sets') }}">Outfits</a></li>
            </ul>
            <ul id="item-mall-nav">
                <li class="add-divider"><a href="{{ url('equipment') }}">Equipment</a></li>
                <li class="add-divider"><a href="{{ url('mercenary-packs') }}">Mercenary Packs</a></li>
                <li>
                    <div style="visibility: hidden"></div>
                    <div style="visibility: hidden">M</div>
                </li>
                <li class="add-divider"><a href="{{ url('mercenaries') }}">Mercenaries</a></li>
                <li class="add-divider"><a href="{{ url('books') }}">Books</a></li>
                <li class="add-divider"><a href="{{ url('clearance-sale') }}">Clearance Sale</a></li>
            </ul> --}}
        {{-- </div> --}}
        <center><img src="{{ asset('assets/i/precioso.png') }}" width="700" height="350" alt=""
                class="jarallax-img"></center>

        @if (session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @elseif(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <div class="items-list clearfix">
            @foreach ($data as $product)
                <div class="item-box" data-productno="{{ $product->product_seq }}">
                    <div class="tag sale en"></div>
                    <div class="item-info">
                        <div class="item-img">
                            <a href="{{ url('shop/item_mall', ['product_no' => $product->product_seq]) }}">
                                {{-- <img src="../assets/images/itemmall/{{ $product->image }}" alt="{{ $product->name }}"> --}}
                                <img src="{{ asset('assets/images/itemmall/' . $product->image) }}"
                                    alt="{{ $product->name }}">

                            </a>
                        </div>
                        <div class="item-desc">
                            <h4><a
                                    href="{{ url('shop/item_mall', ['product_no' => $product->product_seq]) }}">{{ $product->name }}</a>
                            </h4>
                            <p class="sale-price">
                                <span class="regular-price"></span><span class="sale">{{ $product->price }}</span>
                                D.A
                            </p>
                        </div>
                    </div>
                    <form action="{{ route('purchase') }}" method="post">@csrf
                        <input type="hidden" name="product_id" value="{{ $product->product_seq }}">
                        <input type="hidden" name="product_price" value="{{ $product->price }}">
                        <button type="submit" class="buy-btn">Buy</button>
                    </form>
                </div>
            @endforeach
        </div>


    </div>
@endsection
