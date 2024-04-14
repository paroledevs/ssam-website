@extends('admin.dashboard')

@section('title', 'Admin | Ubicaciones')

@section('bar_title', 'Ubicaciones')

@section('search_route', 'locations.index')

{{-- Seccion de items --}}
@section('items')

    <a href="{{ route('locations.create') }}">
        <div class="item location_item new">
            <label>Nueva ubicación</label>
        </div>
    </a>

    @foreach ($locations as $location)
        <a href="{{ route('locations.edit', compact('location')) }}">
            <div class="item location_item">

                <div class="foto" :style="imgBackground('{{ $location->cover }}')"></div>

                <div class="texto">
                    <strong>{{ $location->name }}</strong>
                </div>

            </div>
        </a>
    @endforeach

    {{ $locations->links() }}

    <panel-config :actions="['hideFilters', 'hideSearch']"></panel-config>


@endsection

{{-- Seccion de items --}}
