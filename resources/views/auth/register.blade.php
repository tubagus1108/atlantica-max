@extends('layouts.app')
@section('content')
<div class="nk-header-title nk-header-title-sm nk-header-title-parallax nk-header-title-parallax-opacity">
    <div class="bg-image">
        <img src="{{asset('assets/images/image-1.png')}}" alt="" class="jarallax-img">
    </div>
    <div class="nk-header-table">
        <div class="nk-header-table-cell">
            <div class="container">
                <h1 class="nk-title">Registration</h1>
            </div>
        </div>
    </div>
</div>
<!-- Register -->
<div class="container">
    <div class="nk-gap-6"></div>
	<div class="nk-gap-2"></div>
    <div class="row vertical-gap lg-gap justify-content-center">
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
                <form class="nk-form nk-form-style-1" method="POST" action="{{route('register.post')}}">@csrf
                    <div class="row vertical-gap">
                        <div class="col-sm-6">
                            <input class="form-control" type="text" placeholder="Username" name="user_id" id="username" value="" autocomplete="username" autofocus required >
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" placeholder="Nickname" name="first_name" id="first_name" value="" autocomplete="first_name" autofocus required >
                        </div>
                    </div>

                    <div class="nk-gap-2"></div>

                    <div class="row vertical-gap">
                        <div class="col-sm-12">
                            <input class="form-control" type="email" placeholder="Email" name="email" id="email" value="" autocomplete="email" autofocus required>
                        </div>
                    </div>

                    <div class="nk-gap-2"></div>

                    <div class="row vertical-gap">
                        <div class="col-sm-6">
                            <input class="form-control" type="password" placeholder="Password" name="password" id="password" autocomplete="new-password" autofocus required>
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="password" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" autofocus required>
                        </div>
                    </div>

                    <div class="nk-gap-2"></div>

                    <div class="row vertical-gap">
                        <div class="col-sm-4">
                            <select class="form-control" name="month" id="month" autocomplete="month" autofocus required>
                                <option hidden disabled selected>Month</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" name="day" id="day" autocomplete="day" autofocus required>
                                <option hidden disabled selected>Day</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" name="year" id="year" autocomplete="year" autofocus required>
                                <option hidden disabled selected>Year</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="birthday" id="birthday">
                    <p class="text-dark-5 small">&nbsp;Date of Birth</p>

                    <select class="form-control" name="gender" id="gender" autocomplete="gender" autofocus required>
                        <option hidden disabled selected>Gender</option>
                    </select>

                    <div class="nk-gap-2"></div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="terms" id="terms" autofocus required>
                            <span class="text-dark-5">I accept the</span>
                            <a class="text-default" href="termsofservice.html" target="_self">Terms of Service</a>
                            <span class="text-dark-5">and</span>
                            <a class="text-default" href="privacypolicy.html" target="_self">Privacy Policy</a>
                        </label>
                    </div>

                    <div class="nk-gap-2"></div>

                    <div class="nk-gap-2"></div>

                    <button class="nk-btn nk-btn-color-white link-effect-4 float-right" type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>
    <div class="nk-gap-6"></div>
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