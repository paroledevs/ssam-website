@extends('layouts.default')

@section('title', '$post->title'. ' | SSAM Restaurante Coreano')

@section('metas')


   	<meta property="og:url" content="{{ Request::url() }}"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="{{ $post->title }}"/>
	<meta property="og:image" content="{{-- $post->cover --}}"/>
	<meta property="og:description" content="{{ optional($post)->previewText() }}"/>
	<meta property="fb:app_id" content=""/>


@endsection


@section('content')

    <div id="post">


        <v-header path="{{ Request::path() }}"></v-header>

        <Gallery :photos="{{ Js::from($post->images ?? []) }}"></Gallery>


        {{-- $post->title --}}
        {{-- $post->description --}}
        {{-- $post->created_at->format('d/m/Y') --}}


        <main>

            <article>
                <div class="centrador">


                    <div id="bloques">


                        @foreach ($post->blocks->sortBy('position') as $block)
                            @switch($block->layout)
                                @case('title')
                                    <div class="bloque title">
                                        <h6>{{ $block->extractContent('text') }}</h6>
                                    </div>
                                @break

                                @case('text')
                                    <div class="bloque text">
                                        <p class="paragraph">{{ $block->extractContent('text') }}</p>
                                    </div>
                                @break

                                @case('list')
                                    <div class="bloque list">
                                        @foreach ($block->extractContent('items') ?? [] as $item)
                                            <p class="paragraph">{{ $item }}</p>
                                        @endforeach
                                    </div>
                                @break
                            @endswitch
                        @endforeach



                    </div>

                    <div id="actions"><a href="{{ route('site.blog') }}"><button class="boton"><span>Volver a recetas</span></button></a></div>

                </div>
            </article>



        </main>

		{{-- <Sharer url="{{ Request::url() }}"></Sharer> --}}
		
		



    </div>

@endsection
