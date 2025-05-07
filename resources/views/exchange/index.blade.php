@extends('layouts.app')

@section('css')
    <style>
        #character-table tbody tr {
            background-color: black;
            /* Warna latar belakang hitam */
            color: white;
            /* Warna teks putih */
        }

        /* Original Exchange Styles */
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group select, .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .btn-exchange {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            text-align: center;
            border-radius: 5px;
        }
        .btn-exchange:hover {
            background-color: #2980b9;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }

        /* Flickering glow effect for discounts above 0% */
        @keyframes flicker {
            0% { text-shadow: 0 0 5px #00ff00, 0 0 10px #00ff00, 0 0 15px #00ff00, 0 0 20px #00ff00; }
            10% { text-shadow: 0 0 10px #00ff00, 0 0 15px #00ff00, 0 0 20px #00ff00, 0 0 25px #00ff00; }
            20% { text-shadow: 0 0 5px #00ff00, 0 0 10px #00ff00, 0 0 15px #00ff00, 0 0 20px #00ff00; }
            30% { text-shadow: 0 0 15px #00ff00, 0 0 20px #00ff00, 0 0 25px #00ff00, 0 0 30px #00ff00; }
            40% { text-shadow: 0 0 10px #00ff00, 0 0 15px #00ff00, 0 0 20px #00ff00, 0 0 25px #00ff00; }
            50% { text-shadow: 0 0 5px #00ff00, 0 0 10px #00ff00, 0 0 15px #00ff00, 0 0 20px #00ff00; }
            60% { text-shadow: 0 0 15px #00ff00, 0 0 20px #00ff00, 0 0 25px #00ff00, 0 0 30px #00ff00; }
            70% { text-shadow: 0 0 10px #00ff00, 0 0 15px #00ff00, 0 0 20px #00ff00, 0 0 25px #00ff00; }
            80% { text-shadow: 0 0 5px #00ff00, 0 0 10px #00ff00, 0 0 15px #00ff00, 0 0 20px #00ff00; }
            90% { text-shadow: 0 0 15px #00ff00, 0 0 20px #00ff00, 0 0 25px #00ff00, 0 0 30px #00ff00; }
            100% { text-shadow: 0 0 5px #00ff00, 0 0 10px #00ff00, 0 0 15px #00ff00, 0 0 20px #00ff00; }
        }

        /* Apply the flickering glow effect to the discount text */
        .glow {
            font-weight: bold;
            animation: flicker 1.5s infinite ease-in-out;
        }

        /* Additional styles for the new layout */
        .exchange-container {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 8px;
            padding: 20px;
            color: white;
        }

        .exchange-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: #3498db;
            text-transform: uppercase;
        }

        .exchange-info {
            margin-bottom: 20px;
            font-size: 16px;
        }

        .exchange-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .exchange-table th {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: left;
        }

        .exchange-table td {
            padding: 10px;
            border-bottom: 1px solid #444;
        }

        .exchange-form {
            background-color: rgba(52, 152, 219, 0.1);
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #3498db;
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
                    <h1 class="nk-title">Exchange Money to M-Cash</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Exchange Content -->
    <div class="nk-box">
        <div class="container">
            <div class="nk-gap-6"></div>
            <div class="nk-gap-2"></div>

            <div id="content">
                <div id="page-content">
                    <div class="exchange-container">
                        <!-- User account info -->
                        <div class="exchange-info">
                            <h2 class="exchange-title">Account Information</h2>
                            <p>M-Cash: <strong>{{ number_format($bond) }} M-Cash</strong></p>

                            @if(isset($rate))
                                <p>Exchange Normal: <strong>{{ number_format($rate) }}</strong> (Diskon: <strong>{{ number_format($rate_gold * 100, 2) }}%</strong>)</p>

                                @php
                                    // Determine the color based on the discount
                                    $discount_color = ($rate_gold == 0) ? 'red' : 'green';
                                    $discount_style = ($rate_gold > 0) ? 'glow' : '';
                                @endphp

                                <p>Rate: <strong class="{{ $discount_style }}" style="color: {{ $discount_color }}">{{ number_format($total_money_per_bond) }} g</strong> = 1 M-Cash</p>
                            @endif

                            @if(session('success'))
                                <p class="success">{{ session('success') }}</p>
                            @endif

                            @if(session('error'))
                                <p class="error">{{ session('error') }}</p>
                            @endif
                        </div>

                        @if(count($characters) > 0)
                            <!-- Characters table -->
                            <div class="exchange-characters">
                                <h2 class="exchange-title">Your Characters</h2>
                                <table class="exchange-table" id="character-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Gold</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($characters as $character)
                                            <tr>
                                                <td>{{ $character->Name }}</td>
                                                <td>{{ number_format($character->Money) }} g</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Exchange form -->
                            <div class="exchange-form">
                                <h2 class="exchange-title">Exchange Gold to M-Cash</h2>

                                <form method="POST" action="{{ route('exchange.process') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="person_id">Select Character:</label>
                                        <select name="person_id" id="person_id" required>
                                            @foreach($characters as $character)
                                                <option value="{{ $character->PersonID }}">
                                                    {{ $character->Name }} (Gold: {{ number_format($character->Money) }} g)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="bond_to_exchange">Amount of M-Cash to exchange:</label>
                                        <input type="number" name="bond_to_exchange" id="bond_to_exchange" min="1" required>
                                    </div>

                                    <button type="submit" class="btn-exchange">Exchange</button>
                                </form>
                            </div>
                        @else
                            <p>You don't have any characters.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="nk-gap-2"></div>
            <div class="nk-gap-6"></div>
        </div>
    </div>
@endsection
