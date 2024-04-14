@extends('admin.website.items')


{{-- Seccion View --}}
@section('preview')
    <div id="website_preview">

    </div>
@endsection
{{-- Seccion View --}}


{{-- Seccion de Form --}}
@section('form')
    <div class="formularios white" id="website_form">


        <v-gallery label="Cover"></v-gallery>

    </div>

    <panel-change-view view="edit_view"></panel-change-view>

    <panel-config :actions="['hideActionDelete', 'hidePreview']"></panel-config>

    <panel-live-view-item live-route="{{ route('site.home') }}"></panel-live-view-item>
@endsection
{{-- Seccion de Form --}}

@push('scripts')
    <script></script>
@endpush
