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