@extends('admin.layouts.app')
@section('bredcrum-title')
    Product
@endsection
@section('bredcrum-menu')
    Product
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

                    <h4 class="card-title">Product Created</h4>
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="main_category">Category :</label>
                            <select name="main_category" id="main_category" class="form-control">
                                <option value="1">{{ __('item-mall.consumables') }}</option>
                                <option value="2">{{ __('item-mall.decorations') }}</option>
                                <option value="3">{{ __('item-mall.equipment') }}</option>
                                <option value="4">{{ __('item-mall.books') }}</option>
                                <option value="5">{{ __('item-mall.mercenaries') }}</option>
                                <option value="6">{{ __('item-mall.mounts') }}</option>
                                <option value="7">{{ __('item-mall.mercenary_packs') }}</option>
                                {{-- <option value="8">mercenary_packs</option> --}}
                                <option value="9">{{ __('item-mall.outfits') }}</option>
                                <option value="10">{{ __('item-mall.boxes') }}</option>
                                <option value="11">{{ __('item-mall.cards') }}</option>
                                <option value="12">{{ __('item-mall.clearance_sale') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name :</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="item_unique">Item Unique :</label>
                            <input type="number" name="item_unique" id="item_unique" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="item_num">Item Num :</label>
                            <input type="number" name="item_num" id="item_num" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="start-date">Start Date:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control">

                            <label for="end-date">End Date:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" name="price" id="price" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="eximage">Eximage:</label>
                            <input type="file" name="eximage" id="eximage" class="form-control-file">
                        </div>

                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="contents">Contents:</label>
                            <input type="text" name="contents" id="contents" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-12">
            <table id="datatable-news" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Lang</th>
                        <th>Title</th>
                        <th>Type Content</th>
                        <th>Image</th>
                        <th>Auction</th>
                        <!-- Tambahkan kolom lain sesuai kebutuhan -->
                    </tr>
                </thead>
            </table>

        </div>
    </div> --}}
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
