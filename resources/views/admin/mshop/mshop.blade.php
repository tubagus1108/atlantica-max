@extends('admin.layouts.app')
@section('bredcrum-title')
    M-Shop Product
@endsection
@section('bredcrum-menu')
M-Shop Product
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

                    <h4 class="card-title">Product M Shop Created</h4>
                    <form action="{{ route('product-mshop.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="category">Category :</label>
                            <select name="category" id="category" class="form-control">
                                <option value="CONSUMABLES">CONSUMABLES</option>
                                <option value="BOX">BOX</option>
                                <option value="CARD">CARD</option>
                                <option value="SEALED ORB">SEALED ORB</option>
                                <option value="EQUIPMENT">EQUIPMENT</option>
                                <option value="MERC_PACK">MERC_PACK</option>
                                <option value="BOOK">BOOK</option>
                                <option value="EVENT">EVENT</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="itemid">Kode Item :</label>
                            <input type="number" name="itemid" id="itemid" class="form-control">
                        </div>


                        <div class="form-group">
                            <label for="name">Name :</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="desc">Deskripsi :</label>
                            <input type="text" name="desc" id="desc" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="desc1">Deskripsi Isi Product :</label>
                            <input type="text" name="desc1" id="desc1" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="desc2">Deskripsi Isi Product 2 :</label>
                            <input type="text" name="desc2" id="desc2" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="desc3">Deskripsi Isi Product 3 :</label>
                            <input type="text" name="desc3" id="desc3" class="form-control">
                        </div>

                        {{-- <div class="form-group">
                            <label for="min_qty">Min Qty :</label>
                            <input type="number" name="min_qty" id="min_qty" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="max_qty">Max Qty :</label>
                            <input type="number" name="max_qty" id="max_qty" class="form-control">
                        </div> --}}
<!--
                        <div class="form-group">
                            <label for="start-date">Start Date:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control">

                            <label for="end-date">End Date:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control">
                        </div> -->

                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" name="price" id="price" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                        </div>

                        <!-- <div class="form-group">
                            <label for="eximage">Eximage:</label>
                            <input type="file" name="eximage" id="eximage" class="form-control-file">
                        </div> -->
<!--
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="contents">Contents:</label>
                            <input type="text" name="contents" id="contents" class="form-control">
                        </div> -->

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
