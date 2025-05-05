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
                    <h1 class="nk-title">Patch Manual</h1>
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
                        <table id="character-table" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Patch</th>
                                    <th>Link Download</th>
                                    <th>Tanggal Patch</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $index => $datas)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $datas->patch_name }}</td>
                                        <td> <a href='{{ $datas->download_link }}' class='btn btn-success btn-sm btn-download' target='_blank'>
                                            Download
                                        </a></td>
                                        <td>{{ $datas->patch_date }}</td>
                                    </tr>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No data available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="nk-gap-2"></div>
            <div class="nk-gap-6"></div>
        </div>
    </div>
@endsection
