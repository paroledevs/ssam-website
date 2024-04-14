@extends('admin.layouts.items')


{{-- Seccion View --}}
@section('preview')

<div id="layout_preview">

</div>

@endsection
{{-- Seccion View --}}


{{-- Seccion de Form --}}
@section('form')

<div class="formularios" id="layout_form">

    <form {{-- action="{{ route('models.update', compact('model')) }}" --}} method="POST" enctype="multipart/form-data" ref="formEdit">
        @csrf
        @method('PUT')



        <button type="button" @click="saveWithSpinner($refs.formEdit)">Done</button>

    </form>



</div>


<panel-change-view view="edit_view"></panel-change-view>

<panel-config :actions="['hideActionDelete', 'hideActionShow', 'hideActions', 'hidePreview']"></panel-config>

<panel-delete-item message="Delete this layout?" delete-route="{{-- {{ route('models.destroy', compact('model')) }} --}}"></panel-delete-item>

<panel-live-view-item live-route="{{-- {{ route('site.', compact('model')) }} --}}"></panel-live-view-item>

@endsection
{{-- Seccion de Form --}}
