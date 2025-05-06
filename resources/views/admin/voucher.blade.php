@extends('admin.layouts.app')
@section('bredcrum-title')
    Voucher
@endsection
@section('bredcrum-menu')
    Voucher
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @if (session('error'))
                        <div class="alert alert-danger text-center">{{ session('error') }}</div>
                    @elseif(session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif

                    <h4 class="card-title">Voucher Created</h4>
                    <form action="{{ route('voucher.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="code">Kode Voucher :</label>
                            <input type="text" name="code" id="code" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="cash_amount">Cash Amount:</label>
                            <input type="number" name="cash_amount" id="cash_amount" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Create Voucher</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // $('#datatable-news').DataTable({
            //     processing: true,
            //     serverSide: true,
            //     ajax: "",
            //     columns: [{
            //             data: 'DT_RowIndex',
            //             name: 'DT_RowIndex'
            //         },
            //         {
            //             data: 'lang',
            //             name: 'lang'
            //         },
            //         {
            //             data: 'title',
            //             name: 'title'
            //         },
            //         {
            //             data: 'type',
            //             name: 'type'
            //         },
            //         {
            //             data: 'image',
            //             name: 'image'
            //         },
            //         {
            //             data: 'action',
            //             name: 'action',
            //         },
            //     ]
            // });
        })
        var itemUniqueInput = document.getElementById("item_unique");
        var itemNumInput = document.getElementById("item_num");
        var priceInput = document.getElementById("price");

        // Menambahkan event listener untuk memvalidasi input saat pengguna menginput
        itemUniqueInput.addEventListener("input", function() {
            // Menghindari nilai yang kurang dari nol
            if (itemUniqueInput.value < 0) {
                itemUniqueInput.value = 0;
            }
        });

        itemNumInput.addEventListener("input", function() {
            // Menghindari nilai yang kurang dari nol
            if (itemNumInput.value < 0) {
                itemNumInput.value = 0;
            }
        });

        priceInput.addEventListener("input", function() {
            // Menghindari nilai yang kurang dari nol
            if (priceInput.value < 0) {
                priceInput.value = 0;
            }
        });
    </script>
@endsection
