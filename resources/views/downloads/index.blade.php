@extends('layouts.app')
@section('content')
    <div class="nk-header-title nk-header-title-sm nk-header-title-parallax nk-header-title-parallax-opacity">
        <div class="bg-image">
            <img src="assets/images/image-1.png" alt="" class="jarallax-img">
        </div>
        <div class="nk-header-table">
            <div class="nk-header-table-cell">
                <div class="container">
                    <h1 class="nk-title">{{ __('dowloads.title') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Client -->
    <div class="nk-box">
        <div class="nk-gap-6"></div>
        <div class="nk-gap-2"></div>
        <div class="nk-carousel-2" data-autoplay="12000" data-dots="true">
            <div class="nk-carousel-inner">
                <div>
                    <div>
                        <blockquote class="nk-testimonial-2">
                            <div class="nk-testimonial-photo"
                                style="background-image: url('assets/images/download/drive.png');"></div>
                            <div class="nk-testimonial-body">
                                <em>
                                    {{ __('client.downlods.version.title') }} <span
                                        class="link-effect-2">{{ __('client.downloads.version') }}</span> |
                                    {{ __('client.downlods.size.title') }} <span
                                        class="link-effect-2">{{ __('client.downloads.size') }}</span> |
                                    {{ __('client.downloads.date.title') }} <span
                                        class="link-effect-2">{{ __('client.downloads.date') }}</span>
                                </em>
                            </div>
                            <div class="nk-testimonial-name h4">
                                <a class="nk-btn nk-btn-lg link-effect-1"
                                    href="https://drive.google.com/file/d/15Xa6XqROTH1dzWNwZ5kpmq0TvL6IL3Ky/view?usp=sharing"
                                    target="_blank">
                                    <span>Google Drive</span>
                                </a>
                            </div>
                        </blockquote>
                    </div>
                </div>
                <div>
                    <div>
                        <blockquote class="nk-testimonial-2">
                            <div class="nk-testimonial-photo"
                                style="background-image: url('assets/images/download/mega.png');"></div>
                            <div class="nk-testimonial-body">
                                <em>
                                    {{ __('client.downlods.version.title') }} <span
                                        class="link-effect-2">{{ __('client.downloads.version') }}</span> |
                                    {{ __('client.downlods.size.title') }} <span
                                        class="link-effect-2">{{ __('client.downloads.size') }}</span> |
                                    {{ __('client.downloads.date.title') }} <span
                                        class="link-effect-2">{{ __('client.downloads.date') }}</span>
                                </em>
                            </div>
                            <div class="nk-testimonial-name h4">
                                <a class="nk-btn nk-btn-lg link-effect-1"
                                    href="https://mega.nz/file/CQsB3IhB#tUQAyTTzqptm7Ywlo1OZODL4Q020oIIPKmtOGxJcbik"
                                    target="_blank">
                                    <span>Mega</span>
                                </a>
                            </div>
                        </blockquote>
                    </div>
                </div>
                <div>
                    <div>
                        <blockquote class="nk-testimonial-2">
                            <div class="nk-testimonial-photo"
                                style="background-image: url('assets/images/download/mediafire.png');"></div>
                            <div class="nk-testimonial-body">
                                <em>
                                    {{ __('client.downlods.version.title') }} <span
                                        class="link-effect-2">{{ __('client.downloads.version') }}</span> |
                                    {{ __('client.downlods.size.title') }} <span
                                        class="link-effect-2">{{ __('client.downloads.size') }}</span> |
                                    {{ __('client.downloads.date.title') }} <span
                                        class="link-effect-2">{{ __('client.downloads.date') }}</span>
                                </em>
                            </div>
                            <div class="nk-testimonial-name h4">
                                <a class="nk-btn nk-btn-lg link-effect-1"
                                    href="https://www.mediafire.com/file/sfwtd0ccgx4x2so/Atlantica-MSV4.rar/file"
                                    target="_blank">
                                    <span>MediaFire</span>
                                </a>
                            </div>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-gap-2"></div>
        <div class="nk-gap-6"></div>
    </div>

    <!-- System Requirements -->
    <div class="nk-box bg-dark-1">
        <div class="container text-center">
            <div class="nk-gap-6"></div>
            <div class="nk-gap-2"></div>
            <h2 class="nk-title h1">{{ __('requirement.title') }}</h2>
            <div class="nk-gap-3"></div>

            <p class="lead">{{ __('requirement.body') }}</p>

            <div class="nk-gap-2"></div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Minimum Requirements</th>
                        <th>Recommended Requirements</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>OS</th>
                        <td>Windows Vista or later</td>
                        <th>Windows 7 or later</th>
                    </tr>
                    <tr>
                        <th>CPU</th>
                        <td>Intel Core 2 Duo E6320, AMD Phenom 8450 or better</td>
                        <td>Intel Core 2 Duo E6320, AMD Phenom 8450 or better</td>
                    </tr>
                    <tr>
                        <th>MEMORY</th>
                        <td>At least 2GB RAM</td>
                        <td>At least 4GB RAM</td>
                    </tr>
                    <tr>
                        <th>VIDEO CARD</th>
                        <td>GeForce GT 240, Radeon HD 5450 or higher (vertex pixel shader 2.0 capable graphics card)</td>
                        <td>GeForce GT 240, Radeon HD 5450 or higher (vertex pixel shader 2.0 capable graphics card)</td>
                    </tr>
                    <tr>
                        <th>HARD DRIVE</th>
                        <td>At least 20GB of free space</td>
                        <td>At least 20GB of free space</td>
                    </tr>
                    <tr>
                        <th>SOUND</th>
                        <td>16 Bit Sound Card</td>
                        <td>16 Bit Sound Card</td>
                    </tr>
                    <tr>
                        <th>DIRECT X</th>
                        <td>DirectX version 9.0 or higher</td>
                        <td>DirectX version 9.0 or higher</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Drivers -->
    <div class="nk-box bg-dark-1">
        <div class="container text-center">
            <div class="nk-gap-6"></div>
            <div class="nk-gap-2"></div>
            <h2 class="nk-title h1">Drivers</h2>
            <div class="nk-gap-3"></div>

            <div class="row no-gutters">
                <div class="col-md-4">
                    <div class="nk-box-2 nk-box-line">
                        <a href="http://www.microsoft.com/downloads/en/details.aspx?FamilyID=2da43d38-db71-4c1b-bc6a-9b6652cd92a3&amp;displayLang=en"
                            target="_blank">
                            <img src="assets/images/download/driver-microsoft-dirextx.png" alt="Direct X 9.0" />
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="nk-box-2 nk-box-line">
                        <a href="https://www.nvidia.com/Download/index.aspx?lang=en-us" target="_blank">
                            <img src="assets/images/download/driver-nvidia.png" alt="NVIDIA Graphic Card" />
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="nk-box-2 nk-box-line">
                        <a href="https://www.amd.com/en/support" target="_blank">
                            <img src="assets/images/download/driver-amd.png" alt="AMD Graphic Card" />
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <div class="nk-gap-2"></div>
        <div class="nk-gap-6"></div>
    </div>
@endsection
