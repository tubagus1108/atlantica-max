@extends('admin.layouts.app')
@section('bredcrum-title')
    Cash
@endsection
@section('bredcrum-menu')
    Add Cash
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

                    <h4 class="card-title">Send cash in user</h4>
                    <form action="{{ route('cash.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">User Id :</label>
                            <input type="text" name="user_id" id="user_id" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="item_unique">Amount :</label>
                            <input type="number" name="cash" id="cash" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Send Cash</button>
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
        var amountInput = document.getElementById("cash");

        // Menambahkan event listener untuk memvalidasi input saat pengguna menginput
        amountInput.addEventListener("input", function() {
            // Menghindari nilai yang kurang dari nol
            if (amountInput.value < 0) {
                amountInput.value = 0;
            }
        });
    </script>
@endsection
