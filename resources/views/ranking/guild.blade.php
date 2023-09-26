@extends('layouts.app')
@section('css')
<style>
    #character-table tbody tr {
        background-color: black; /* Warna latar belakang hitam */
        color: white; /* Warna teks putih */
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
                <h1 class="nk-title">Ranking - Top Clanes</h1>
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
                                <th>#</th>
                                <th>Clan</th>
                                <th>Level</th>
                                <th>EXP</th>
                            </tr>
                        </thead>
                    </table>                    
                </div>
            </div>
        </div>

        <div class="nk-gap-2"></div>
        <div class="nk-gap-6"></div>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#character-table').DataTable({
                ajax: {
                    url :'{{route('guilds.datatable')}}',
                },
                "columns": [
                    { "data": "DT_RowIndex", name: 'DT_RowIndex', orderable: false, searchable: false },
                    { "data": "name" },
                    { "data": "level" },
                    { "data": "experience" }
                ],
                "searching": false, // Menghilangkan opsi pencarian
                "lengthChange": false, // Menghilangkan opsi items per page
                "bDestroy": true,
                "processing": true,
                "serverSide": true,
            });
        });

    </script>    
@endsection