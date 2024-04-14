@extends('admin.layouts.items')

{{-- Seccion de Form --}}
@section('form')

<div class="formularios" id="layout_form">

    <form {{-- action="{{ route('models.store') }}" --}} method="POST" enctype="multipart/form-data" ref="formCreate">
        @csrf


        <button type="button" @click="saveWithSpinner($refs.formCreate)">Done</button>

    </form>


</div>


<panel-change-view view="edit_view"></panel-change-view>

<panel-config :actions="['hideActions', 'hidePreview']"></panel-config>


@endsection
{{-- Seccion de Form --}}

