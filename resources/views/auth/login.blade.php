@extends('layouts.app')
@section('content')
<div class="nk-header-title nk-header-title-sm nk-header-title-parallax nk-header-title-parallax-opacity">
    <div class="bg-image">
        <img src="{{asset('assets/images/image-1.png')}}" alt="" class="jarallax-img">
    </div>
    <div class="nk-header-table">
        <div class="nk-header-table-cell">
            <div class="container">
                <h1 class="nk-title">Login</h1>
            </div>
        </div>
    </div>
</div>
<!-- Login -->
<div class="container">
    <div class="nk-gap-6"></div>
    <div class="nk-gap-2"></div>

    <div class="row vertical-gap lg-gap">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="nk-box-3 bg-dark-1">
                @if($errors->has('errors'))
                    <div class="col-md-12">
                        <div class="nk-info-box bg-main-1">
                            <ul>
                                <li>{{ $errors->first('errors') }}</li>
                            </ul>
                        </div>
                    </div>
                @endif            
                <form class="nk-form nk-form-style-1" method="POST" action="{{route('login.post')}}">
                    @csrf

                    <input class="form-control" type="text" placeholder="Username" name="identify" id="identify" value="{{ old('identify') }}" autocomplete="identify" autofocus required>
                    
                    <div class="nk-gap-2"></div>

                    <input class="form-control" type="password" placeholder="Password" name="password" id="password" autocomplete="current-password" required>
                    
                    <div class="nk-gap-2"></div>
                    
                    <div class="form-check float-left">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            Remember Me
                        </label>
                    </div>

                    <button class="nk-btn nk-btn-color-white link-effect-4 float-right" type="submit">Login</button>
                    
                    <div class="clearfix"></div>
                    <div class="nk-gap-1"></div>
                    <a class="nk-sign-form-lost-toggle float-right" href="">Forgot your password?</a>
                </form>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="nk-gap-6"></div>
    <div class="nk-gap-2"></div>
</div>


@endsection

@section('script')
<script>
    (function ($) {
        var $month = $('select[name=month]');
        var $day = $('select[name=day]');
        var $year = $('select[name=year]');
        var $gender = $('select[name=gender]');

        function addOpts($item, from, to) {
            var result = '';
            if ($.isArray(from)) {
                for (var k = 0; k < from.length; k++) {
                    result += '<option value="' + from[k] + '">' + from[k] + '</option>';
                }
            } else if (from && to) {
                if (from > to) {
                    for (var k = from; k >= to; k--) {
                        result += '<option value="' + k + '">' + k + '</option>';
                    }
                } else {
                    for (var k = from; k <= to; k++) {
                        result += '<option value="' + k + '">' + k + '</option>';
                    }
                }
            }
            $item.append(result);
        }

        addOpts($month, ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']);
        addOpts($day, 1, 31);
        addOpts($year, 2013, 1900);
        addOpts($gender, ['male', 'female']);
    }(jQuery));

    const monthDropdown = document.getElementById('month');
    const dayDropdown = document.getElementById('day');
    const yearDropdown = document.getElementById('year');
    const birthdayInput = document.getElementById('birthday');

    // Event handler untuk setiap dropdown
    monthDropdown.addEventListener('change', updateBirthday);
    dayDropdown.addEventListener('change', updateBirthday);
    yearDropdown.addEventListener('change', updateBirthday);

    // Fungsi untuk menggabungkan nilai dari dropdown menjadi satu tanggal
    function updateBirthday() {
        const month = monthDropdown.value;
        const day = dayDropdown.value;
        const year = yearDropdown.value;

        // Buat format tanggal dengan format YYYY-MM-DD
        const birthday = year + '-' + month + '-' + day;
        birthdayInput.value = birthday;
    }
</script>

@endsection