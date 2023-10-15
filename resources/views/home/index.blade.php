@extends('layouts.app')

@section('content')
    <div class="nk-header-title nk-header-title-lg nk-header-title-parallax nk-header-title-parallax-opacity">
        <div class="bg-image">
            <img src="{{ asset('assets/images/image-1.png') }}" alt="" class="jarallax-img">
        </div>
        <div class="nk-header-table">
            <div class="nk-header-table-cell">
                <div class="container">
                    {{-- {{session('user')}} --}}
                    <div class="nk-header-text">
                        <h1 class="nk-title display-3">Atlantica Max Supreme</h1>
                        <div class="nk-gap-2"></div>

                        @if (session()->has('user'))
                            {{-- <a class="nk-btn nk-btn-lg nk-btn-color-main-1 link-effect-4" href="{{ route('download') }}"> --}}
                            <a class="nk-btn nk-btn-lg nk-btn-color-main-1 link-effect-4" href="">
                                <span>Download the game</span>
                            </a>
                        @else
                            <a class="nk-btn nk-btn-lg nk-btn-color-main-1 link-effect-4"
                                href="{{ route('register.index') }}">
                                <span>{{ __('home.join') }}</span>
                            </a>
                        @endif

                        <div class="nk-gap-4"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('news')
    <h2 class="nk-post-title h3">
        <a>Parche v.4.23.98</a>
    </h2>
    <div class="nk-post-date">2023-09-01</div>
    <p></p>
    <br>✓ Se corriguio y mejoro Habilidades de Merlin
    <br>✓ Se retiraron NCP de Lima [Hui Chao] [San Martin] [Simon Bolivar]
    <BR>
    <center>
        <FONT COLOR="yellow">Nuevos Items agregados</FONT>
    </center>
    <p>Items tipo piedra guardian otorgan un efecto de defensa magica tipo montura, se reduciran por
        cada golpe recibido, disponible en Nueva masmorra
        <BR>Defensa Magica TNK III
        <BR>Defensa Magica TNK II
        <BR>Defensa Magica TNK I
        <BR>Defensa Magica KRS III
        <BR>Defensa Magica KRS II
        <BR>Defensa KRS Magica I
        <BR>Defensa Magica CNG III
        <BR>Defensa Magica CNG II
        <br>✓ Usuarios conectados iguales o mayor Lv 130 recibiran [Caja Aleatoria Espectacular] cada 45
        minutos de coneccion. (todos)
        <br>✓ Nueva Masmorra disponible Bosque Grimm. nivel minino 155 recomendado 165
        <br>✓ Quest de Repeticion Diaria. Hermanos Grimm
        <br>✓ Item CASH disponible desde la tienda x1500unidades.
        <br>✓ Mejoras en premios por horas de coneccion
        <br>✓ Aumento en proceso de mejora con Vulcanus
        <br>✓ Creaciónes individuales en grado +2 en adelante.
        <br>✓ Iniciaran batallas T-E-A. <a class="link-effect-2" href="../even.php" target="_blank">Que es T-E-A(aqui)</a>
        <br>✓ Nuevos Mercenarios disponibles.
        <br>✓ NCP de Quest Lima Eternos
        <br>✓ Ver contenido de pack premium Merlin. <a class="link-effect-2" href="../i/merl.png" target="_blank">AQUI
            DETALLES</a>
        <br>✓ Ver contenido de pack Armado premium Folklorista. <a class="link-effect-2" href="../i/grinbro.png"
            target="_blank">AQUI DETALLES</a>
        <br>✓ Evento Mejora continuas. <a class="link-effect-2" href="../even.php" target="_blank">AQUI DETALLES</a>
        <br>✓ Evento Busca de Tesoros. <a class="link-effect-2" href="../even.php" target="_blank">AQUI DETALLES</a>
        <br>✓ Orbe de Folklorista Lv 140 (Cañonero) Disponible en la tienda.
        <br>✓ Orbe de Archi Mago Merlin Lv 140 (Mago) Disponible en la tienda.
    <p></p>
@endsection
