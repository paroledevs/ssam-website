@extends('admin.dashboard')

@section('title', 'Admin | Website')

@section('bar_title', 'Website')

{{-- Seccion de items --}}
@section('items')


    <a href="{{ route('website.home') }}">
        <div class="item website_item">

            <div class="texto">
                <strong>Home</strong>
            </div>

        </div>
    </a>

    <a href="{{ route('website.catering') }}">
        <div class="item website_item">

            <div class="texto">
                <strong>Catering</strong>
            </div>

        </div>
    </a>


    <panel-config :actions="['hideFilters', 'hideSearch']"></panel-config>


@endsection

{{-- Seccion de items --}}
