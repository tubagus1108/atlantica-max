@extends('admin.layouts.app')
@section('bredcrum-title')
    News
@endsection
@section('bredcrum-menu')
    news
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">News Created</h4>
                    <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="lang">Language (EN or ES or RU):</label>
                            <select name="lang" id="lang" class="form-control">
                                <option value="en">EN</option>
                                <option value="es">ES</option>
                                <option value="ru">RU</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="type">Type Content:</label>
                            <select name="type" id="type" class="form-control">
                                <option value="Announce">Announce</option>
                                <option value="Update">Update</option>
                                <option value="Event">Event</option>
                                <option value="Notice">Notice</option>
                                <option value="Maintenance">Maintenance</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="content">Content:</label>
                            <textarea name="content" id="content" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                        </div>
                        <button type="submit" class="btn btn-primary">Create News</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
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
    </div>
    {{-- Modal News --}}
    <div class="modal fade" id="editNews" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="box_edit_news">
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#content'))
                .catch(error => {
                    console.error(error);
                });
        });
        $(document).ready(function() {
            $('#datatable-news').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('datatable.news') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'lang',
                        name: 'lang'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            });
        })
        editNews = (link) => {
            $.ajax({
                url: link,
                success: function(response) {
                    $('#box_edit_news').html(response)
                }
            })
        }
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
@endsection
