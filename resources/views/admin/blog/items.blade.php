@extends('admin.dashboard')

@section('title', 'Admin | Recetas')

@section('bar_title', 'Recetas')

{{-- Seccion de items --}}
@section('items')

    <a href="{{ route('posts.create') }}">
        <div class="item blog_item new">
            <label>Nueva Receta</label>
        </div>
    </a>

    @foreach ($posts as $post)
        <a href="{{ route('posts.edit', compact('post')) }}">
            <div class="item blog_item {{ $post->isVisibleFor('no_one') ? 'off' : '' }}">

                <div class="foto" :style="imgBackground('{{ $post->mainImage }}')"></div>

                <div class="texto">
                    <strong>{{ $post->title }}</strong>
                    <span>{{ $post->category->title }}</span>
                </div>

            </div>
        </a>
    @endforeach

    {{ $posts->links() }}

    <panel-config :actions="['hideFilters', 'hideSearch']"></panel-config>

@endsection

{{-- Seccion de items --}}
