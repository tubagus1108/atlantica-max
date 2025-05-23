@extends('layouts.app')
@section('content')
<style>
    .description-box {
        display: none;
        position: absolute;
        background-color: #1a1a1a;
        color: white;
        padding: 10px;
        border: 1px solid #888;
        z-index: 1000;
        max-width: 300px;
        font-size: 12px;
        line-height: 1.4;
    }
    .relative-container {
        position: relative;
    }
    </style>
    <!-- Header Title -->
    <div class="nk-header-title nk-header-title-sm nk-header-title-parallax nk-header-title-parallax-opacity">
        <div class="bg-image">
            <img src="{{ asset('assets/images/image-1.png') }}" alt="" class="jarallax-img">
        </div>
        <div class="nk-header-table">
            <div class="nk-header-table-cell">
                <div class="container">
                    <h1 class="nk-title">M SHOP</h1>
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
                <li class="add-divider"><a href="{{ url('mshop/CONSUMABLES') }}">CONSUMABLES</a></li>
                <li class="add-divider"><a href="{{ url('mshop/BOX') }}">BOX</a></li>
                <li class="add-divider"><a href="{{ url('mshop/CARD') }}">CARD</a></li>
                <li class="add-divider"><a href="{{ url('mshop/SEALED_ORB') }}">SEALED ORB</a></li>
            </ul>
            <ul id="item-mall-nav">
                <li class="add-divider"><a href="{{ url('mshop/EQUIPMENT') }}">EQUIPMENT</a></li>
                <li class="add-divider"><a href="{{ url('mshop/MERC_PACK') }}">MERC PACK</a></li>
                <li>
                    <div style="visibility: hidden"></div>
                    <div style="visibility: hidden">M</div>
                </li>
                <li class="add-divider"><a href="{{ url('mshop/BOOK') }}">BOOK</a></li>
                <li class="add-divider"><a href="{{ url('mshop/EVENT') }}">EVENT</a></li>
            </ul>
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
                    <div class="relative-container">
                        <button onclick="toggleDescription({{ $product->itemid }})">View Description</button>
                        <div id="description-{{ $product->itemid }}" class="description-box">
                            {!! $product->desc1 !!}
                        </div>
                    </div>
                    <a>
                        <img width="30%"
                            src="{{ asset('assets/images/itemmall/m_shop/' . $product->name . $product->image) }}"
                            alt="{{ $product->name }}"
                            onerror="this.src='{{ asset('assets/images/itemmall/img_shop/default.png') }}';">
                    </a>
                    </div>
                    <div class="item-desc">
                        <p class="sale-price">
                            <span class="regular-price"></span><span class="sale">{{ $product->price }}</span>
                            Cash
                        </p>
                    </div>
                </div>
                <form action="{{ route('purchase-mshop') }}" method="post">@csrf
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
            <div class="nk-gap-2"></div>
            <div class="nk-gap-6"></div>
        </div>
    </div>
    <script>
        function toggleDescription(id) {
             const el = document.getElementById('description-' + id);
             el.style.display = (el.style.display === 'block') ? 'none' : 'block';
         }
     </script>
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
