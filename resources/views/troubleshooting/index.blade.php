@extends('layouts.app')

@section('content')
    <!-- Header Title -->
    <div class="nk-header-title nk-header-title-sm nk-header-title-parallax nk-header-title-parallax-opacity">
        <div class="bg-image">
            <img src="{{ asset('assets/images/image-1.png') }}"" alt="" class="jarallax-img">
        </div>
        <div class="nk-header-table">
            <div class="nk-header-table-cell">
                <div class="container">
                    <h1 class="nk-title">{{ __('troubleshooting.title') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="nk-box bg-dark-1">
        <div class="container">
            <div class="nk-gap-6"></div>
            <div class="nk-gap-2"></div>

            <div class="row vertical-gap">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h4 class="nk-title">{{ __('troubleshooting') }}</h4>
                    <div class="nk-gap-2"></div>

                    <div class="nk-accordion" id="accordion-1" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="accordion-1-1-heading">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-1" href="#accordion-1-1"
                                    aria-expanded="false" aria-controls="accordion-1-1">{{ __('launcher') }}</a>
                            </div>
                            <div id="accordion-1-1" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="accordion-1-1-heading">
                                <div class="nk-gap-1"></div>
                                <h5 class="nk-title text-danger">1) {{ __('launcher_error') }}</h5>
                                <div class="nk-gap-1"></div>
                                <img class="nk-img" src="assets/images/troubleshooting/launcher/net_framewo.png"
                                    alt="">
                                <div class="nk-gap-1"></div>
                                <p>{{ __('download_file') }} <a class="link-effect-2" href="/i/resolver.rar"
                                        target="_blank">
                                        {{ __('download_file_extract') }}</a></p>
                                <p>{{ __('install_physx') }} <a class="link-effect-2" href="/i/PhysX.exe" target="_blank">
                                        {{ __('install_physx_here') }}</a>
                                <p>{{ __('vc_redist') }} <a class="link-effect-2"
                                        href="https://learn.microsoft.com/en-us/cpp/windows/latest-supported-vc-redist?view=msvc-170"
                                        target="_blank"> {{ __('micrsoft_corporation') }}</a>
                                <p>{{ __('download_directx') }} <a class="link-effect-2"
                                        href="https://www.microsoft.com/en-us/download/details.aspx?id=35&6B49FDFB-8E5B-4B07-BC31-15695C5A2143=1"
                                        target="_blank"> {{ __('micrsoft_corporation') }}</a>
                                <div class="nk-gap-2"></div>
                                <div class="nk-gap-1"></div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="accordion-1-2-heading">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-1" href="#accordion-1-2"
                                    aria-expanded="false" aria-controls="accordion-1-2">{{ __('gameguard') }}</a>
                            </div>
                            <div id="accordion-1-2" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="accordion-1-2-heading">
                                <div class="nk-gap-1"></div>
                                <h5 class="nk-title text-danger">1) {{ __('tda_gameguard_bug') }}</h5>
                                <div class="nk-gap-1"></div>
                                <img class="nk-img" src="assets/images/troubleshooting/gameguard/ert.png" alt="">
                                <div class="nk-gap-1"></div>
                                <p>- {{ __('solution_1') }}<br>- {{ __('solution_2') }}<br>- {{ __('solution_3') }} <a
                                        class="link-effect-2" href="https://discord.gg/UtM3WDt8b"
                                        target="_blank">{{ __('solution_3_discord') }}</a>
                                    {{ __('solution_3_discord_clickhere') }}
                                </p>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="accordion-1-3-heading">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion-1" href="#accordion-1-3"
                                    aria-expanded="false" aria-controls="accordion-1-3">{{ __('login_issues') }}</a>
                            </div>

                            <div id="accordion-1-3" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="accordion-1-3-heading">
                                <div class="nk-gap-1"></div>
                                <h5 class="nk-title text-danger">{{ __('login_issues') }}</h5>
                                <div class="nk-gap-1"></div>
                                <img class="nk-img" src="assets/images/troubleshooting/gameguard/loag.png" alt="">
                                <div class="nk-gap-1"></div>
                                <p>- {{ __('download_tdaagg') }} <a class="link-effect-2" href="/i/resolver.rar"
                                        target="_blank">{{ __('downloads') }}</a>
                                <p>{{ __('download_solution') }}<a class="link-effect-2" href="/i/resolver.rar"
                                        target="_blank">{{ __('download_solution_now') }}</a></p>
                                {{ __('download_solution_again') }}
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="nk-gap-2"></div>
            <div class="nk-gap-6"></div>
        </div>
    </div>
@endsection
