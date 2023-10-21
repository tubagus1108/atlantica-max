<div class="card">
    <div class="card-body">
        <h4 class="card-title">News Edit</h4>
        <form action="{{ route('ajax.news-edit.post', $data['id']) }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $data['id'] }}">
            <div class="form-group">
                <label for="lang">Language (EN or ES):</label>
                <select name="lang" id="lang" class="form-control">
                    <option value="en" {{ $data['lang'] === 'en' ? 'selected' : '' }}>EN</option>
                    <option value="es" {{ $data['lang'] === 'es' ? 'selected' : '' }}>ES</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $data['title'] }}">
            </div>
            <div class="form-group">
                <label for="type">Type Content:</label>
                <select name="type" id="type" class="form-control">
                    <option value="Announce" {{ $data['type'] === 'Announce' ? 'selected' : '' }}>Announce</option>
                    <option value="Update" {{ $data['type'] === 'Update' ? 'selected' : '' }}>Update</option>
                    <option value="Event" {{ $data['type'] === 'Event' ? 'selected' : '' }}>Event</option>
                    <option value="Notice" {{ $data['type'] === 'Notice' ? 'selected' : '' }}>Notice</option>
                    <option value="Maintenance" {{ $data['type'] === 'Maintenance' ? 'selected' : '' }}>Maintenance
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" id="content-edit" class="form-control" rows="5">{{ $data['content'] }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" id="image" class="form-control-file" accept="image/*">
                <input type="hidden" name="image" value="{{ $data['image'] }}">
            </div>
            <button type="submit" class="btn btn-primary">Edit News</button>
        </form>
    </div>
</div>
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#content-edit'))
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection
