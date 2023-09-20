@extends('layouts.app')
@section('content')
<div class="nk-header-title nk-header-title-sm nk-header-title-parallax nk-header-title-parallax-opacity">
    <div class="bg-image">
        <img src="{{ asset('assets/images/image-1.png') }}" alt="" class="jarallax-img">
    </div>
    <div class="nk-header-table">
        <div class="nk-header-table-cell">
            <div class="container">
                <h1 class="nk-title">Information</h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="nk-social-profile nk-social-profile-container-offset">
        <div class="row">
            <div class="col-md-5 col-lg-3">
                <div class="nk-social-profile-avatar">
                    <img src="{{ asset('assets/images/gender.png') }}" alt="Male" title="Male">
                </div>
            </div>
            <div class="col-md-7 col-lg-9">
                <div class="nk-social-profile-info">
                    <div class="nk-gap-2"></div>
                    <div class="nk-social-profile-info-last-seen">
                        <button class="bg-main-2 text-white">
                            <span class="fa fa-money"></span>&nbsp;{{ number_format(session('user')->cash, 0, ',', ' ') }}
                        </button>
                    </div>
                    <h1 class="nk-social-profile-info-name">{{ session('user')->f_name }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row vertical-gap">
        <div class="col-lg-3"></div>
        <div class="col-lg-9">
            <div class="nk-gap-2 d-none d-lg-block"></div>
            <div class="nk-social-container">
                <ul class="nk-social-friends">
                    <li>
                        <div class="nk-social-friends-avatar">
                            <img src="{{ asset('assets/images/gender.png') }}" alt="Male" title="Male">
                        </div>
                        <div class="nk-social-friends-content">
                            <div class="nk-social-friends-info" style="width: 100%;">
                                <div class="nk-social-friends-name">Nickname&nbsp;<span class="nk-social-friends-meta">{{ session('user')->f_name }}</span></div>
                                <div class="nk-social-friends-name">Username (Login ID)&nbsp;<span class="nk-social-friends-meta">{{ session('user')->user_id }}</span></div>
                                <div class="nk-social-friends-name">Email&nbsp;<span class="nk-social-friends-meta">{{ session('user')->email }}</span></div>
                                <div class="nk-social-friends-name">Gender&nbsp;<span class="nk-social-friends-meta">{{ session('user')->user_gender === 'm' ? 'Male' : 'Female' }}</span></div>
                                <div class="nk-social-friends-name">Birthday&nbsp;<span class="nk-social-friends-meta">{{ \Carbon\Carbon::parse(session('user')->user_birthday)->format('Y-m-d') }}</span></div>
                                <div class="nk-social-friends-name">Created Date&nbsp;<span class="nk-social-friends-meta">{{ \Carbon\Carbon::parse(session('user')->reg_date)->format('F j, Y, g:i a') }}</span></div>
                                <div class="nk-gap-3"></div>
                                <a class="nk-btn btn-block nk-btn-color-dark-1 nk-btn-bg-white" href="/user/purchase">
                                    <span class="fa fa-money"></span>&nbsp;Purchase Cash
                                </a>
                                <a class="nk-btn btn-block nk-btn-color-dark-1 nk-btn-bg-white" href="">
                                    <span class="fa fa-key"></span>&nbsp;Reset Password
                                </a>
                                <a class="nk-btn btn-block nk-btn-color-white nk-btn-bg-danger" href="{{ route('logout') }}">
                                    <span class="ion-log-out"></span>&nbsp;Logout
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="nk-gap-6"></div>
    <div class="nk-gap-2"></div>
</div>
@endsection