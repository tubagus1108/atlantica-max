@extends('layouts.app')
@section('css')
    <style>
        #character-table tbody tr {
            background-color: black;
            /* Warna latar belakang hitam */
            color: white;
            /* Warna teks putih */
        }
    </style>
@endsection

@section('content')
    <div class="nk-header-title nk-header-title-sm nk-header-title-parallax nk-header-title-parallax-opacity">
        <div class="bg-image">
            <img src="{{ asset('assets/images/image-1.png') }}" alt="" class="jarallax-img">
        </div>
        <div class="nk-header-table">
            <div class="nk-header-table-cell">
                <div class="container">
                    <h1 class="nk-title">Sell Coin</h1>
                </div>
            </div>
        </div>
    </div>

      <!-- Top Players -->
      <div class="nk-box">
        <div class="container text-center">
            <div class="nk-gap-6"></div>
            <div class="nk-gap-2"></div>

            <div id="content">
                <div id="page-content">
                    <div class="animate__animated animate__bounceInUp">
                        <form method="GET" action="{{ route('user.inventory') }}">
                            <select name="character_id">
                                @foreach ($characters as $char)
                                    <option value="{{ $char->PersonID }}" {{ request('character_id') == $char->PersonID ? 'selected' : '' }}>
                                        {{ $char->Name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" name="select_character">Lihat Inventaris</button>
                        </form>

                        @if(session('success'))
                            <p style="color: green">{{ session('success') }}</p>
                        @elseif(session('error'))
                            <p style="color: red">{{ session('error') }}</p>
                        @endif

                        @if(!empty($inventory))
                            <h3>Inventory</h3>
                            <div class="inventory-grid">
                                @foreach ($inventory as $item)
                                    <div>
                                        <strong>{{ $itemNames[$item->ItemUnique] ?? 'Unknown Item' }}</strong><br>
                                        Jumlah: {{ $item->ItemNum }}<br>
                                        <form method="POST" action="{{ route('user.inventory.sell') }}">
                                            @csrf
                                            <input type="hidden" name="item_id" value="{{ $item->ItemUnique }}">
                                            <input type="hidden" name="character_id" value="{{ $item->PersonID }}">
                                            <input type="number" name="quantity" min="1" max="{{ $item->ItemNum }}" required>
                                            <button type="submit" name="sell_item">Jual</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="nk-gap-2"></div>
            <div class="nk-gap-6"></div>
        </div>
      </div>

@endsection
