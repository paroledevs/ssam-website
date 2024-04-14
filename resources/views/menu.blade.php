@extends('layouts.default')


@section('title','Menú | SSAM Restaurante Coreano')

@section('metas')

   	<meta property="og:url" content="{{ Request::url() }}"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="SSAM"/>
	<meta property="og:image" content="{{ asset('images/meta_img.jpg') }}"/>
	<meta property="og:description" content="Restaurante Coreano"/>
	<meta property="fb:app_id" content=""/>

@endsection


@section('content')

    <div id="themenu">


        <v-header path="{{ Request::path() }}"></v-header>

        <Promos :promos="{{ Js::from($promos ?? []) }}"></Promos>

        <main>

            <div class="navigation" id="top">
                <div class="centrador">
                    <nav>
                        <div class="link"><a href="{{ route('site.menu') }}"><span>Ver todo</span></a></div>
                        @foreach ($categories as $category)
                            <div class="link"><a href="{{ $category->link }}"><span>{{ $category->title }}</span></a></div>
                        @endforeach
                    </nav>
                </div>
            </div>


            <section id="menu">
                <div class="centrador">

                    @foreach ($groups as $category => $dishes)
                        <div class="categoria">
                            <h6>{{ $category }}</h6>
                            <div class="platos">


                                @foreach ($dishes as $dish)
                                    <div class="plato">
                                        <div class="foto">
                                            <div class="blurfoto" :style="imgBackground('{{ $dish->cover }}')"></div>
                                        </div>
                                        <div class="info">
                                            <b>{{ $dish->title }}</b>
                                            <span>{{ $dish->description }}</span>
                                        </div>
                                    </div>
                                @endforeach





                            </div>
                        </div>
                    @endforeach

                </div>
            </section>


            <div class="navigation" id="bottom">
                <div class="centrador">
                    <nav>
                        <div class="link"><a href="{{ route('site.menu') }}"><span>Ver todo</span></a></div>
                        @foreach ($categories as $category)
                            <div class="link"><a href="{{ $category->link }}"><span>{{ $category->title }}</span></a></div>
                        @endforeach
                    </nav>
                </div>
            </div>

        </main>


    </div>

@endsection
