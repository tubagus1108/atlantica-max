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

        <div id="item-mall-nav-wrap">
            <ul id="item-mall-nav">
                <li class="add-divider"><a href="{{ url('item/1') }}">{{ __('item-mall.consumables') }}</a></li>
                <li class="add-divider"><a href="{{ url('item/6') }}">{{ __('item-mall.mounts') }}</a></li>
                <li class="add-divider"><a href="{{ url('item/10') }}">{{ __('item-mall.boxes') }}</a></li>
                <li class="add-divider"><a href="{{ url('item/2') }}">{{ __('item-mall.decorations') }}</a></li>
                <li class="add-divider"><a href="{{ url('item/11') }}">{{ __('item-mall.cards') }}</a></li>
                <li><a href="{{ url('item/9') }}">{{ __('item-mall.outfits') }}</a></li>
            </ul>
            <ul id="item-mall-nav">
                <li class="add-divider"><a href="{{ url('item/3') }}">{{ __('item-mall.equipment') }}</a></li>
                <li class="add-divider"><a href="{{ url('item/7') }}">{{ __('item-mall.mercenary_packs') }}</a></li>
                <li>
                    <div style="visibility: hidden"></div>
                    <div style="visibility: hidden">M</div>
                </li>
                <li class="add-divider"><a href="{{ url('item/5') }}">{{ __('item-mall.mercenaries') }}</a></li>
                <li class="add-divider"><a href="{{ url('item/4') }}">{{ __('item-mall.books') }}</a></li>
                <li class="add-divider"><a href="{{ url('item/12') }}">{{ __('item-mall.clearance_sale') }}</a></li>
            </ul>
        </div>
        <center><img src="{{ asset('assets/i/precioso.png') }}" width="700" height="350" alt=""
                class="jarallax-img"></center>

        @if (session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @elseif(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <div class="items-list clearfix">
            @foreach ($data as $product)
                @if ($product->main_category == 0)
                    <div class="item-box product" data-productno="{{ $product->product_seq }}">
                        <div class="tag sale en"></div>
                        <div class="item-info">
                            <div class="item-img">
                                <a href="{{ url('shop/item_mall', ['product_no' => $product->product_seq]) }}">
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
                @else
                    <div class="item-box product" data-productno="{{ $product->product_seq }}">
                        <div class="tag sale en"></div>
                        <div class="item-info">
                            <div class="item-img">
                                <a href="{{ url('shop/item_mall', ['product_no' => $product->product_seq]) }}">
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
                @endif
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
