@extends('layouts.default')


@section('title','Catering | SSAM Restaurante Coreano')

@section('metas')

   	<meta property="og:url" content="{{ Request::url() }}"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="SSAM"/>
	<meta property="og:image" content="{{ asset('images/meta_img.jpg') }}"/>
	<meta property="og:description" content="Restaurante Coreano"/>
	<meta property="fb:app_id" content=""/>

@endsection


@section('content')

    <div id="catering">

        <v-header path="{{ Request::path() }}"></v-header>

        <div id="portada" class="title">
            <div class="blurfoto active" style="background: url('/images/jpg/catering.jpg')no-repeat center center;"></div>
            <div class="blurcolor"></div>
            <div class="centrador">
                <div class="centro">
                    <h2>Catering.</h2>
                </div>
            </div>
        </div>

        <main>

            <section id="eventos">
                <div class="centrador">

                    <div class="info">
                        <h6>Catering en Guadalajara</h6>
                        <p class="paragraph">Nuestros restaurantes en Guadalajara ofrecen una variedad de opciones para eventos especiales y privados, incluyendo recepciones corporativas y de negocios.

                            Por favor haz clic en el botón para llenar la forma y podamos ponernos en contacto contigo.</p>
                    </div>


                    <div class="info" id="paquetes">
                        <h6>Paquetes</h6>

                        @foreach ($caterings as $catering)
                            <div class="paquete">
                                <b>{{ $catering->title }}</b>
                                <p class="paragraph">{{ $catering->description }}</p>
                            </div>
                        @endforeach


                    </div>

                    <div id="actions"><a href="{{ route('site.contact') }}"><button class="boton"><span>Llenar forma de solicitud</span></button></a></div>

                </div>
            </section>


        </main>


    </div>

@endsection
