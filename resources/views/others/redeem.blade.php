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
                    <h1 class="nk-title">Redeem Code</h1>
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
                      {{-- Error Umum (bukan validasi, misalnya login gagal) --}}
                      @if ($errors->has('errors'))
                      <div class="col-md-12">
                          <div class="nk-info-box bg-main-1">
                              {{ $errors->first('errors') }}
                          </div>
                      </div>
                      @endif

                      @if (session('success'))
                      <div class="col-md-12">
                          <div class="nk-info-box bg-main-1">
                          {{ session('success') }}
                          </div>
                      </div>
                      @endif
                    <div class="animate__animated animate__bounceInUp">
                        <form method="POST" action="{{ route('redeem.submit') }}">
                            @csrf
                            <div class="form-group">
                                <label for="code">Kode Redeem:</label>
                                <input type="text" name="code" id="code" required>
                            </div>
                            <div class="form-group">
                                <button type="submit">Redeem</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="nk-gap-2"></div>
            <div class="nk-gap-6"></div>
        </div>
      </div>

@endsection
