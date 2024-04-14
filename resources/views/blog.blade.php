@extends('layouts.default')


@section('title','Recetas | SSAM Restaurante Coreano')

@section('metas')

   	<meta property="og:url" content="{{ Request::url() }}"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="SSAM"/>
	<meta property="og:image" content="{{ asset('images/meta_img.jpg') }}"/>
	<meta property="og:description" content="Restaurante Coreano"/>
	<meta property="fb:app_id" content=""/>

@endsection


@section('content')

    <div id="blog">


        <v-header path="{{ Request::path() }}"></v-header>


        <main>

            <div id="title">
                <h2>Recetas.</h2>
            </div>

            <div class="navigation">
                <div class="centrador">
                    <nav>
                        <div class="link"><a href="{{ route('site.blog') }}"><span>Ver todo</span></a></div>
                        @foreach ($categories as $category)
                            <div class="link"><a href="{{ $category->link }}"><span>{{ $category->title }}</span></a></div>
                        @endforeach
                    </nav>
                </div>
            </div>

            <section id="recetas">
                <div class="centrador">
                    <div id="recipes">
                        @foreach ($posts as $post)
                            <div class="recipe">
                                <a href="{{ $post->link }}">
                                    <div class="foto">
                                        <div class="blurfoto" style="background: url('{{ $post->mainImage }}')no-repeat center center;"></div>
                                    </div>
                                </a>
                                <div class="info">
                                    <b>{{ $post->title }}</b>
                                    <span>{{ $post->description }}</span>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>
            </section>



        </main>

    </div>

@endsection
