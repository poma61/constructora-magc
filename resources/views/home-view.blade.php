@extends('layouts.app')
@section('title', 'MAGC | Administracion')

@section('template_content')

@section('template_content')

    <div class="card mt-5" style="min-height:85vh">

        <div class="card-content">
            <h1
                class="as-main-title has-background-primary is-size-5 has-text-centered has-text-white has-text-white animate__animated animate__bounce">
                Bienvenido al sistema MAGC
            </h1>

            <div class="tile is-ancestor">
                <div class="tile is-vertical is-8">
                    <div class="tile">
                        <div class="tile is-parent is-vertical">
                            <article class="tile is-child notification is-info">
                                <p class="title">Vision</p>
                                <div class="content">
                                    <p>
                                        Ser destacada por la excelencia en lo que hacemos,
                                        por ser confiable para nuestros
                                        clientes y comprometida con nuestros colaboradores.
                                    </p>
                                </div>
                            </article>
                            <article class="tile is-child notification is-info">
                                <p class="title">Mision</p>
                                <div class="content">
                                    <p>
                                        MAGC CONSTRUCTORA & CONSULTORA trabaja cada día para brindar el mejor servicio de
                                        construcción, con todas las herramientas necesarias para crear una obra segura,
                                        elegante, bonita y cómoda. Ganar clientes satisfechos que recomienden nuestros
                                        servicios
                                        en un futuro cercano.
                                    </p>
                                </div>
                            </article>
                        </div>
                        <div class="tile is-parent">
                            <article class="tile is-child notification is-info">
                                <p class="title">¿Quienes somos?</p>
                                <div class="content">
                                    <p>
                                        Somos una empresa 100% boliviana dedicada a la construcción en general, tenemos 10
                                        años
                                        de experiencia al servicio de nuestros clientes, posicionándonos como empresa líder
                                        en
                                        el mercado gracias a la preferencia de nuestros clientes.
                                        Todos nuestros servicios están garantizados, recibirás la mejor atención y te
                                        ayudaremos
                                        a encontrar la solución más adecuada para tus necesidades.
                                    </p>
                                    <figure class="image is-4by3">
                                        <img  src="{{ asset('src/images/home-1.jpeg') }}">
                                    </figure>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child notification">
                            <div class="content">
                                <figure class="image is-2by1">
                                    <img src="{{ asset('src/images/home-2.jpeg') }}">
                                </figure>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child notification">
                        <div class="content">
                            <p class="title">Proyectos</p>
                            <div class="content">
                                <figure class="image is-4by3">
                                    <img src="{{ asset('src/images/home-3.jpeg') }}">
                                </figure>
                                <figure class="image is-4by3">
                                    <img src="{{ asset('src/images/home-4.jpeg') }}">
                                </figure>
                                <figure class="image is-4by3">
                                    <img src="{{ asset('src/images/home-5.jpg') }}">
                                </figure>
                                <figure class="image is-4by3">
                                    <img src="{{ asset('src/images/home-6.jpg') }}">
                                </figure>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

        </div>
    </div>

@endsection
