@extends('admin.dashboard')

@section('title', 'Admin | Highlights')

@section('bar_title', 'Highlights')

{{-- Seccion de items --}}
@section('items')

    <a href="{{ route('promos.create') }}">
        <div class="item promo_item new">
            <label>Nuevo promo</label>
        </div>
    </a>

    @foreach ($promos as $promo)
        <a href="{{ route('promos.edit', compact('promo')) }}">
            <div class="item promo_item">
                <div class="foto" :style="imgBackground('{{ $promo->cover }}')"></div>
            </div>
        </a>
    @endforeach

    {{ $promos->links() }}

    <panel-config :actions="['hideFilters', 'hideSearch']"></panel-config>

@endsection

{{-- Seccion de items --}}
