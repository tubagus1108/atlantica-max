@foreach ($data as $item)
    <div class="nk-blog-post">
        <div class="nk-post-thumb">
            <div class="nk-post-category">
                <a class="link-effect-1">{{ $item->type }}</a>
            </div>
            <img src="{{ asset('atlantica-max/public/storage/' . $item->image) }}" class="nk-img-stretch" alt="Image">
        </div>
        <div class="nk-post-content">
            <h2 class="nk-post-title h3">
                <a>{{ $item->title }}</a>
            </h2>
            <div class="nk-post-date">{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</div>
            <div class="nk-post-text">
                <p>
                    {!! $item->content !!}
                </p>
            </div>
        </div>
    </div>
@endforeach

<div class="nk-pagination nk-pagination-center">
    <nav>
        @if ($data->currentPage() > 1)
            <a class="nk-pagination-previous" href="javascript:"
                onclick="pagination('/news', {{ $data->currentPage() - 1 }}, 1)">
                <span class="nk-icon-arrow-left"></span>
            </a>
        @endif

        @for ($i = 1; $i <= $data->lastPage(); $i++)
            <a href="javascript:" onclick="pagination('/news', {{ $i }}, 1)"
                class="{{ $i === $data->currentPage() ? 'nk-pagination-current-white' : '' }}">{{ $i }}</a>
        @endfor

        @if ($data->hasMorePages())
            <a class="nk-pagination-next" href="javascript:"
                onclick="pagination('/news', {{ $data->currentPage() + 1 }}, 1)">
                <span class="nk-icon-arrow-right"></span>
            </a>
        @endif
    </nav>
</div>

@section('script')
    <script>
        function pagination(path, id, scroll) {
            $.ajax({
                type: 'GET',
                dataType: 'HTML',
                data: '',
                url: path + '?page=' + id, // Pass the page number as a query parameter
                success: function(data) {
                    $("#page-content").html('<div class="animate__animated animate__bounceInUp">' + data +
                        '</div>');
                    if (scroll == 1)
                        document.getElementById('content').scrollIntoView({
                            block: "start",
                            behavior: "smooth"
                        });
                }
            });
        }
    </script>
@endsection
