@extends('admin.dashboard')

@section('title', 'Admin | Menu')

@section('bar_title', 'Menu')

@section('search_route', 'menu.index')

{{-- Seccion de items --}}
@section('items')

    <a href="{{ route('menu.create') }}">
        <div class="item menu_item new">
            <label>Nuevo Platillo</label>
        </div>
    </a>

    @foreach ($dishes as $dish)
        <a href="{{ route('menu.edit', compact('dish')) }}">
            <div class="item menu_item">

                <div class="foto" :style="imgBackground('{{ $dish->cover }}')"></div>

                <div class="texto">
                    <strong>{{ $dish->title }}</strong>
                    <span>{{ $dish->category->title }}</span>
                </div>

            </div>
        </a>
    @endforeach

    {{ $dishes->links() }}

    <panel-config :actions="['hideFilters', 'hideSearch']"></panel-config>


@endsection

{{-- Seccion de items --}}
