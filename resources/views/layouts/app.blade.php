<!doctype html>
<html lang="es">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="index.html">
    <meta name="keywords"
        content="MMORPG, RPG, action game, online, free to play, Atlantica Online download, real-time combat, VFUN Atlantica, VALOFE Atlantica, Atlantica Online, game Atlantica Online, Atlantica Max">
    <meta name="description"
        content="MMORPG, RPG, action game, online, free to play, Atlantica Online download, real-time combat, VFUN Atlantica, VALOFE Atlantica, Atlantica Online, game Atlantica Online, Atlantica Max">


    <title>{{ env('APP_NAME') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300i,400,400i,700%7cMarcellus+SC"
        rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/dist/css/bootstrap.min.css') }}">

    <!-- FontAwesome -->
    <script defer src="{{ asset('assets/vendor/fontawesome-free/js/all.js') }}"></script>
    <script defer src="{{ asset('assets/vendor/fontawesome-free/js/v4-shims.js') }}"></script>

    <!-- IonIcons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/ionicons/css/ionicons.min.css') }}">

    <!-- Revolution Slider -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/revolution/css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/revolution/css/layers.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/revolution/css/navigation.css') }}">

    <!-- Flickity -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/flickity/dist/flickity.min.css') }}">

    <!-- Photoswipe -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/photoswipe/dist/photoswipe.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/photoswipe/dist/default-skin/default-skin.css') }}">

    <!-- DateTimePicker -->
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/jquery-datetimepicker/build/jquery.datetimepicker.min.css') }}">

    <!-- Summernote -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/dist/summernote-bs4.css') }}">

    <!-- ATLANTICA MAX -->
    <link rel="stylesheet" href="{{ asset('assets/css/at-max.css') }}">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!-- Animate -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate/animate.min.css') }}">

    <!-- Loading -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/loading/loading.css') }}">

    <!-- jQuery -->
    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>

    <!-- Google reCAPTCHA -->
    {{-- <script src="../www.google.com/recaptcha/api.js" async defer></script> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

    @yield('css')
</head>

<body>
    <!-- Preloader -->
    <div class="nk-preloader">
        <div class="nk-preloader-bg" style="background-color: #000;" data-close-frames="23" data-close-speed="1.2"
            data-close-sprites="assets/images/preloader-bg.png" data-open-frames="23" data-open-speed="1.2"
            data-open-sprites="assets/images/preloader-bg-bw.png">
        </div>

        <div class="nk-preloader-content">
            <div>
                <img class="nk-img" src="{{ asset('assets/images/logo.png') }}" alt="Atlantica Max Supreme"
                    width="170">
                <div class="nk-preloader-animation"></div>
            </div>
        </div>

        <div class="nk-preloader-skip">Skip</div>
    </div>

    <!-- Video Background -->
    <div class="nk-page-background op-5" data-video="" data-video-loop="true" data-video-mute="true"
        data-video-volume="0" data-video-start-time="0" data-video-end-time="0" data-video-pause-on-page-leave="true"
        style="background-image: url('{{ asset('assets/images/page-background.jpg') }}');">
    </div>

    <!-- Audio Background -->
    <div class="nk-page-background-audio d-none" data-audio="assets/mp3/login.ogg" data-audio-volume="100"
        data-audio-autoplay="true" data-audio-loop="true" data-audio-pause-on-page-leave="true">
    </div>

    <!-- Border -->
    <div class="nk-page-border">
        <div class="nk-page-border-t"></div>
        <div class="nk-page-border-r"></div>
        <div class="nk-page-border-b"></div>
        <div class="nk-page-border-l"></div>
    </div>

    <!-- Header -->
    <header class="nk-header nk-header-opaque">
        <!-- Contacts & Server Time -->
        <div class="nk-contacts-top">
            <div class="container">
                <div class="nk-contacts-left">
                    <div class="nk-navbar">
                        <ul class="nk-nav">
                            <li><a><span class="fa fa-clock"></span>&nbsp;{{ __('local_time') }}</a></li>
                            <li><a id="servertime">00:00:00</a></li>
                            <li><a><span class="fa fa-clock"></span>&nbsp;{{ __('server_time') }}</a></li>
                            <li><iframe style="padding-top:3px;"
                                    src="https://free.timeanddate.com/clock/i8uieqpf/n34/fs13/fcfff/tct/pct/ftb/th1"
                                    frameborder="0" width="53" height="17" allowtransparency="true"></iframe>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="nk-contacts-right">
                    <div class="nk-navbar">
                        <ul class="nk-nav">
                            <li><a href="" target="_blank"><span class="fab fa-facebook"></span></a></li>
                            <li><a href="https://discord.gg/D4m8Hn57" target="_blank"><span
                                        class="fab fa-discord"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Navbar -->
        <nav class="nk-navbar nk-navbar-top nk-navbar-sticky nk-navbar-transparent nk-navbar-autohide">
            <div class="container">
                <div class="nk-nav-table">

                    <a href="#" class="nk-nav-logo">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="" width="100">
                    </a>

                    {{-- <ul class="nk-nav nk-nav-right d-none d-lg-block" data-nav-mobile="#nk-nav-mobile">
                        @if (app()->getLocale() == 'en')
                            <li class="nk-drop-item">
                                <a href="#"><span class="fa fa-globe"></span> {{ __('language') }}</a>
                                <ul class="dropdown">
                                    <li class="{{ app()->getLocale() == 'en' ? 'active' : '' }}"><a
                                            href="{{ url('locale/en') }}">English</a></li>
                                    <li class="{{ app()->getLocale() == 'es' ? 'active' : '' }}"><a
                                            href="{{ url('locale/es') }}">Spanish </a></li>
                                    <li class="{{ app()->getLocale() == 'ru' ? 'active' : '' }}"><a
                                            href="{{ url('locale/ru') }}">Rusia </a></li>
                                    <!-- Tambahkan pilihan bahasa lain di sini jika diperlukan -->
                                </ul>
                            </li>
                        @endif
                        @if (app()->getLocale() == 'es')
                            <li class="nk-drop-item">
                                <a href="#"><span class="fa fa-globe"></span> {{ __('language') }}</a>
                                <ul class="dropdown">
                                    <li class="{{ app()->getLocale() == 'es' ? 'active' : '' }}"><a
                                            href="{{ url('locale/es') }}">Spanish</a></li>
                                    <li class="{{ app()->getLocale() == 'en' ? 'active' : '' }}"><a
                                            href="{{ url('locale/en') }}">English </a></li>
                                    <li class="{{ app()->getLocale() == 'ru' ? 'active' : '' }}"><a
                                            href="{{ url('locale/ru') }}">Rusia </a></li>
                                    <!-- Tambahkan pilihan bahasa lain di sini jika diperlukan -->
                                </ul>
                            </li>
                        @endif
                        @if (app()->getLocale() == 'ru')
                            <li class="nk-drop-item">
                                <a href="#"><span class="fa fa-globe"></span> {{ __('language') }}</a>
                                <ul class="dropdown">
                                    <li class="{{ app()->getLocale() == 'ru' ? 'active' : '' }}"><a
                                            href="{{ url('locale/ru') }}">Rusia </a></li>
                                    <li class="{{ app()->getLocale() == 'es' ? 'active' : '' }}"><a
                                            href="{{ url('locale/es') }}">Spanish</a></li>
                                    <li class="{{ app()->getLocale() == 'en' ? 'active' : '' }}"><a
                                            href="{{ url('locale/en') }}">English </a></li>
                                    <!-- Tambahkan pilihan bahasa lain di sini jika diperlukan -->
                                </ul>
                            </li>
                        @endif
                        <li class="{{ Request::is('home.index') ? 'active' : '' }}">
                            <a href="{{ route('home.index') }}"><span class="fa fa-home"></span>
                                {{ __('home') }}</a>
                        </li>
                        <li class="{{ Request::is('downloads') ? 'active' : '' }}">
                            <a href="{{ route('downloads') }}"><span class="fa fa-cloud-download"></span>
                                {{ __('downloads') }}</a>
                        </li>
                        <li class="nk-drop-item">
                            <a href="#"><span class="fa fa-bar-chart"></span> {{ __('ranking') }}</a></a>
                            <ul class="dropdown">
                                <li class="{{ Request::is('ranking/characters') ? 'active' : '' }}">
                                    <a href="{{ route('characters') }}">{{ __('ranking.characters') }}</a>
                                </li>
                                <li class="{{ Request::is('ranking/guilds') ? 'active' : '' }}">
                                    <a href="{{ route('guilds') }}">{{ __('ranking.guild') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nk-drop-item">
                            <a href="#"><span class="fa fa-info-circle"></span> {{ __('guide') }}</a>
                            @if (app()->getLocale() == 'en')
                                <ul class="dropdown">
                                    <li class="{{ Request::is('guide/eng') ? 'active' : '' }}">
                                        <a href="{{ route('guide.eng') }}">English</a>
                                    </li>
                                </ul>
                            @endif
                            @if (app()->getLocale() == 'es')
                                <ul class="dropdown">
                                    <li class="{{ Request::is('guide/eng') ? 'active' : '' }}">
                                        <a href="">Spanish</a>
                                    </li>
                                </ul>
                            @endif
                        </li>

                        <li class="nk-drop-item">
                            <a href="#"><span class="fa fa-book"></span>&nbsp;Help</a>
                            <ul class="dropdown">
                                <li class="">
                                    <a href="/troubleshooting"><span
                                            class="fa fa-book"></span>&nbsp;Troubleshooting</a>
                                </li>
                                <!-- <li class="">
                                    <a href="#"><span class="fa fa-question"></span>&nbsp;FAQ</a>
                                </li> -->
                            </ul>
                        </li>

                        @if (session()->has('user'))
                            <li class="nk-drop-item">
                                <a href="#" class="text-success"><span class="fa fa-user fa-w-14"></span>
                                    {{ session('user')->user_id }} &nbsp;&nbsp;<span
                                        class="fa fa-money-bill-alt fa-w-20"></span>
                                    {{ number_format(session('user')->cash, 0, ',', ' ') }}</a>
                                <ul class="dropdown">
                                    <li class="{{ Request::is('profile') ? 'active' : '' }}">
                                        <a href="{{ route('user.information') }}"><span
                                                class="fa fa-user fa-w-14"></span> My Account</a>
                                    </li>
                                    <li class="{{ Request::is('item-mall') ? 'active' : '' }}">
                                        <a href="{{ route('item-mall') }}"><span
                                                class="fa fa-shopping-cart"></span>Item
                                            Mall</a>
                                    </li>
                                    <li class="">
                                        <a href="{{ route('logout') }}" class="text-danger"><span
                                                class="ion-log-out"></span> Logout</a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nk-drop-item">
                                <a href="#"><span class="fa-user-circle"></span> {{ __('login') }} |
                                    {{ __('register') }}</a>
                                <ul class="dropdown">
                                    <li class="{{ Request::is('register') ? 'active' : '' }}">
                                        <a href="{{ route('register.index') }}"><span class="fa fa-user-plus"></span>
                                            {{ __('register') }}</a>
                                    </li>
                                    <li class="{{ Request::is('login') ? 'active' : '' }}">
                                        <a href="{{ route('login.index') }}"><span class="fa fa-sign-in"></span>
                                            {{ __('login') }}</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul> --}}

                    <ul class="nk-nav nk-nav-right d-none d-lg-block" data-nav-mobile="#nk-nav-mobile">
                        @if (app()->getLocale() == 'en')
                            <li class="nk-drop-item">
                                <a href="#"><span class="fa fa-globe"></span> {{ __('language') }}</a>
                                <ul class="dropdown">
                                    <li class="{{ app()->getLocale() == 'en' ? 'active' : '' }}"><a
                                            href="{{ url('locale/en') }}">English</a></li>
                                    <li class="{{ app()->getLocale() == 'es' ? 'active' : '' }}"><a
                                            href="{{ url('locale/es') }}">Spanish </a></li>
                                    <li class="{{ app()->getLocale() == 'ru' ? 'active' : '' }}"><a
                                            href="{{ url('locale/ru') }}">Rusia </a></li>
                                    <!-- Tambahkan pilihan bahasa lain di sini jika diperlukan -->
                                </ul>
                            </li>
                        @endif
                        @if (app()->getLocale() == 'es')
                            <li class="nk-drop-item">
                                <a href="#"><span class="fa fa-globe"></span> {{ __('language') }}</a>
                                <ul class="dropdown">
                                    <li class="{{ app()->getLocale() == 'es' ? 'active' : '' }}"><a
                                            href="{{ url('locale/es') }}">Spanish</a></li>
                                    <li class="{{ app()->getLocale() == 'en' ? 'active' : '' }}"><a
                                            href="{{ url('locale/en') }}">English </a></li>
                                    <li class="{{ app()->getLocale() == 'ru' ? 'active' : '' }}"><a
                                            href="{{ url('locale/ru') }}">Rusia </a></li>
                                    <!-- Tambahkan pilihan bahasa lain di sini jika diperlukan -->
                                </ul>
                            </li>
                        @endif
                        @if (app()->getLocale() == 'ru')
                            <li class="nk-drop-item">
                                <a href="#"><span class="fa fa-globe"></span> {{ __('language') }}</a>
                                <ul class="dropdown">
                                    <li class="{{ app()->getLocale() == 'ru' ? 'active' : '' }}"><a
                                            href="{{ url('locale/ru') }}">Rusia </a></li>
                                    <li class="{{ app()->getLocale() == 'es' ? 'active' : '' }}"><a
                                            href="{{ url('locale/es') }}">Spanish</a></li>
                                    <li class="{{ app()->getLocale() == 'en' ? 'active' : '' }}"><a
                                            href="{{ url('locale/en') }}">English </a></li>
                                    <!-- Tambahkan pilihan bahasa lain di sini jika diperlukan -->
                                </ul>
                            </li>
                        @endif
                        <li class="{{ Request::is('home.index') ? 'active' : '' }}">
                            <a href="{{ route('home.index') }}"><span class="fa fa-home"></span>
                                {{ __('home') }}</a>
                        </li>
                        <li class="{{ Request::is('downloads') ? 'active' : '' }}">
                            <a href="{{ route('downloads') }}"><span class="fa fa-cloud-download"></span>
                                {{ __('downloads') }}</a>
                        </li>
                        <li class="nk-drop-item">
                            <a href="#"><span class="fa fa-bar-chart"></span> {{ __('ranking') }}</a></a>
                            <ul class="dropdown">
                                <li class="{{ Request::is('ranking/characters') ? 'active' : '' }}">
                                    <a href="{{ route('characters') }}">{{ __('ranking.characters') }}</a>
                                </li>
                                <li class="{{ Request::is('ranking/guilds') ? 'active' : '' }}">
                                    <a href="{{ route('guilds') }}">{{ __('ranking.guild') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nk-drop-item">
                            <a href="#"><span class="fa fa-info-circle"></span> {{ __('guide') }}</a>
                            @if (app()->getLocale() == 'en')
                                <ul class="dropdown">
                                    <li class="{{ Request::is('guide/eng') ? 'active' : '' }}">
                                        <a href="{{ route('guide.eng') }}">English</a>
                                    </li>
                                </ul>
                            @endif
                            @if (app()->getLocale() == 'es')
                                <ul class="dropdown">
                                    <li class="{{ Request::is('guide/eng') ? 'active' : '' }}">
                                        <a href="">Spanish</a>
                                    </li>
                                </ul>
                            @endif
                        </li>
                        <li class="nk-drop-item">
                            <a href="#"><span class="fa fa-book"></span>&nbsp;Help</a>
                            <ul class="dropdown">
                                <li class="">
                                    <a href="{{ route('troubleshooting') }}">&nbsp;Troubleshooting</a>
                                </li>
                            </ul>
                        </li>
                        @if (session()->has('user'))
                            <li class="nk-drop-item">
                                <a class="text-success" href="#">
                                    <span
                                        class="fa fa-user-o"></span>&nbsp;{{ substr(session('user')->user_id, 0, 6) }}
                                    &nbsp;&nbsp;
                                    <span
                                        class="fa fa-money"></span>&nbsp;{{ number_format(session('user')->cash, 0, ',', ' ') }}
                                </a>
                                <ul class="dropdown">
                                    <li class="{{ Request::is('profile') ? 'active' : '' }}">
                                        <a href="{{ route('user.information') }}"><span
                                                class="fa fa-user fa-w-14"></span> My Account</a>
                                    </li>
                                    <li class="{{ Request::is('item-mall') ? 'active' : '' }}">
                                        <a href="{{ route('item-mall') }}"><span
                                                class="fa fa-shopping-cart"></span>Item
                                            Mall</a>
                                    </li>
                                    {{-- <li class="{{ Request::is('person.index') ? 'active' : '' }}">
                                        <a href="{{ route('person.index') }}"><span
                                                class="fa fa-user fa-w-14"></span>Create Person</a>
                                    </li> --}}
                                    @if (session('MasterLevelValue') > '104')
                                        <li class="{{ Request::is('admin/news') ? 'active' : '' }}">
                                            <a href="{{ route('admin.news') }}"><span
                                                    class="fa fa-user fa-w-14"></span>Administration</a>
                                        </li>
                                    @endif
                                    <li class="">
                                        <a href="{{ route('logout') }}" class="text-danger"><span
                                                class="ion-log-out"></span> Logout</a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nk-drop-item">
                                <a href="#"><span class="fa-user-circle"></span> {{ __('login') }} |
                                    {{ __('register') }}</a>
                                <ul class="dropdown">
                                    <li class="{{ Request::is('register') ? 'active' : '' }}">
                                        <a href="{{ route('register.index') }}"><span class="fa fa-user-plus"></span>
                                            {{ __('register') }}</a>
                                    </li>
                                    <li class="{{ Request::is('login') ? 'active' : '' }}">
                                        <a href="{{ route('login.index') }}"><span class="fa fa-sign-in"></span>
                                            {{ __('login') }}</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>

                    <ul class="nk-nav nk-nav-right nk-nav-icons">
                        <li class="single-icon d-lg-none">
                            <a href="#" class="no-link-effect" data-nav-toggle="#nk-nav-mobile">
                                <span class="nk-icon-burger">
                                    <span class="nk-t-1"></span>
                                    <span class="nk-t-2"></span>
                                    <span class="nk-t-3"></span>
                                </span>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <!-- End Navbar -->

    </header>
    <!-- End Header -->

    <!-- Navbar Mobile -->
    <div id="nk-nav-mobile" class="nk-navbar nk-navbar-side nk-navbar-left-side nk-navbar-overlay-content d-lg-none">
        <div class="nano">
            <div class="nano-content">
                <a href="" class="nk-nav-logo">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" width="90">
                </a>
                <div class="nk-navbar-mobile-content">
                    <ul class="nk-nav">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Navbar Mobile -->
    <!-- Content -->
    <div class="nk-main">
        @yield('content')
    </div>
    <!-- End Content -->
    {{-- News --}}
    @yield('news')
    {{-- News End --}}
    {{-- Footer --}}
    <footer class="nk-footer nk-footer-parallax nk-footer-parallax-opacity">
        <img class="nk-footer-top-corner" src="{{ asset('assets/images/footer-corner.png') }}" alt="">

        <div class="container">
            <div class="nk-gap-2"></div>
            <div class="nk-footer-logos">
                <a href="#" target="_blank"><img class="nk-img" src="{{ asset('assets/images/logo.png') }}"
                        alt="" width="120"></a>
            </div>
            <div class="nk-gap"></div>

            <p>{{ __('footer.one') }}</p>
            <p>{{ __('footer.two') }}</p>

            <div class="nk-gap-2"></div>

            <div class="nk-gap-4"></div>
        </div>
    </footer>

    {{-- End Footer --}}
    <!-- Object Fit Polyfill -->
    <script src="{{ asset('assets/vendor/object-fit-images/dist/ofi.min.js') }}"></script>

    <!-- GSAP -->
    <script src="{{ asset('assets/vendor/gsap/src/minified/TweenMax.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/gsap/src/minified/plugins/ScrollToPlugin.min.js') }}"></script>

    <!-- Popper -->
    <script src="{{ asset('assets/vendor/popper.js/dist/umd/popper.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Sticky Kit -->
    <script src="{{ asset('assets/vendor/sticky-kit/dist/sticky-kit.min.js') }}"></script>

    <!-- Jarallax -->
    <script src="{{ asset('assets/vendor/jarallax/dist/jarallax.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jarallax/dist/jarallax-video.min.js') }}"></script>

    <!-- imagesLoaded -->
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>

    <!-- Flickity -->
    <script src="{{ asset('assets/vendor/flickity/dist/flickity.pkgd.min.js') }}"></script>

    <!-- Isotope -->
    <script src="{{ asset('assets/vendor/isotope-layout/dist/isotope.pkgd.min.js') }}"></script>

    <!-- Photoswipe -->
    <script src="{{ asset('assets/vendor/photoswipe/dist/photoswipe.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/photoswipe/dist/photoswipe-ui-default.min.js') }}"></script>

    <!-- Typed.js -->
    <script src="{{ asset('assets/vendor/typed.js/lib/typed.min.js') }}"></script>

    <!-- Jquery Validation -->
    <script src="{{ asset('assets/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>

    <!-- Jquery Countdown + Moment -->
    <script src="{{ asset('assets/vendor/jquery-countdown/dist/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/moment-timezone/builds/moment-timezone-with-data.min.js') }}"></script>

    <!-- Hammer.js -->
    <script src="{{ asset('assets/vendor/hammerjs/hammer.min.js') }}"></script>

    <!-- NanoSroller -->
    <script src="{{ asset('assets/vendor/nanoscroller/bin/javascripts/jquery.nanoscroller.js') }}"></script>

    <!-- SoundManager2 -->
    {{-- <script src="{{ asset('assets/vendor/soundmanager2/script/soundmanager2-nodebug-jsmin.js') }}"></script> --}}

    <!-- DateTimePicker -->
    <script src="{{ asset('assets/vendor/jquery-datetimepicker/build/jquery.datetimepicker.full.min.js') }}"></script>

    <!-- Revolution Slider -->
    <script src="{{ asset('assets/vendor/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>

    <!-- Keymaster -->
    <script src="{{ asset('assets/vendor/keymaster/keymaster.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('assets/vendor/summernote/dist/summernote-bs4.min.js') }}"></script>

    <!-- ATLANTICA MAX -->
    <script src="{{ asset('assets/js/at-max.min.js') }}"></script>
    <script src="{{ asset('assets/js/at-max-init.js') }}"></script>

    <!-- Custom -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @yield('script')

    <script type="text/javascript">
        var tpj = jQuery;
        var revapi50;
        tpj(document).ready(function() {
            if (tpj("#rev_slider_50_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_50_1");
            } else {
                revapi50 = tpj("#rev_slider_50_1").show().revolution({
                    sliderType: "carousel",
                    jsFileLocation: "/assets/vendor/revolution/js/",
                    sliderLayout: "auto",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        keyboardNavigation: "off",
                        keyboard_direction: "horizontal",
                        onHoverStop: "off",
                    },
                    carousel: {
                        maxRotation: 8,
                        vary_rotation: "off",
                        minScale: 20,
                        vary_scale: "off",
                        horizontal_align: "center",
                        vertical_align: "center",
                        fadeout: "off",
                        vary_fade: "off",
                        maxVisibleItems: 3,
                        infinity: "on",
                        space: -90,
                        stretch: "off"
                    },
                    responsiveLevels: [1240, 1024, 778, 480],
                    gridwidth: [800, 600, 400, 320],
                    gridheight: [600, 400, 320, 280],
                    lazyType: "none",
                    shadow: 0,
                    spinner: "off",
                    stopLoop: "on",
                    stopAfterLoops: 0,
                    stopAtSlide: 0,
                    shuffle: "off",
                    autoHeight: "off",
                    fullScreenAlignForce: "off",
                    fullScreenOffsetContainer: "",
                    fullScreenOffset: "",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }
        });

        function pagination(path, id, scroll) {

            $.ajax({
                type: 'GET',
                dataType: 'HTML',
                data: '',
                url: path + '?page=' + id,
                success: function(data) {
                    $("#page-content").html(
                        '<center> <div class="lds-dual-ring"></div> </center> <div class="nk-gap-4"></div>');
                    window.setTimeout(function() {
                        $("#page-content").html('<div class="animate__animated animate__bounceInUp">' +
                            data + '</div>')

                        //
                        if (scroll == 1)
                            document.getElementById('content').scrollIntoView({
                                block: "start",
                                behavior: "smooth"
                            });
                    }, 2000);
                }
            });
        }
    </script>

</body>

</html>
