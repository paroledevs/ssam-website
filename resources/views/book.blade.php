@extends('layouts.default')


@section('title','Reserva | SSAM Restaurante Coreano')

@section('metas')

   	<meta property="og:url" content="{{ Request::url() }}"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="SSAM"/>
	<meta property="og:image" content="{{ asset('images/meta_img.jpg') }}"/>
	<meta property="og:description" content="Restaurante Coreano"/>
	<meta property="fb:app_id" content=""/>

@endsection


@section('content')

    <div id="book">

        <v-header path="{{ Request::path() }}"></v-header>


        <main>

            <div id="title">
                <h2>Reserva</h2>
            </div>

            <section id="reserva">
                <div class="centrador">

                    <div id="locations">


                        @foreach ($locations as $location)
                            <div class="location">
                                <div class="foto">
									<a href="{{ $location->link }}">
                                    <div class="blurfoto" :style="imgBackground('{{ $location->cover }}')"></div>
									</a>
                                </div>
                                <div class="info">
                                    <b>{{ $location->name }}</b>
                                    <p>{{ $location->address }}</p>
                                    <p>{{ $location->timetable }}</p>
                                    <p>{{ $location->contact }}</p>
									@if(filled($location->book))
									<a href="{{ $location->book }}">
										<button class="boton"><span>Reserva</span></button>
									</a>
									@endif
                                </div>
                            </div>
                        @endforeach



                    </div>

                </div>
            </section>

        </main>

    </div>

@endsection
