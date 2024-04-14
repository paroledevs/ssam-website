@extends('admin.dashboard')

@section('title', 'Admin | Layouts')

@section('bar_title', 'Layouts')

@section('search_route', 'layouts.index')

{{-- Seccion de items --}}
@section('items')

<a href="{{ route('layouts.create') }}">
    <div class="item layout_item new">
        <label>New</label>
    </div>
</a>

<a href="{{ route('layouts.edit') }}">
    <div class="item layout_item off highlight">

        <div class="foto"></div>

        <div class="texto">
            <strong></strong>
            <span></span>
        </div>

    </div>
</a>

{{-- {{ $layouts->links() }} --}}

<panel-config :actions="['hideFilters', 'hideSearch']"></panel-config>


@endsection

{{-- Seccion de items --}}
