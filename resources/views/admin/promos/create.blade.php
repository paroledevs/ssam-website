@extends('admin.promos.items')

{{-- Seccion de Form --}}
@section('form')
    <div class="formularios white" id="promo_form">

        <form action="{{ route('promos.store') }}" method="POST" enctype="multipart/form-data" ref="createForm">
            @csrf

            <div class="fotos">
                <div class="foto">
                    <input type="file" name="cover" @change="setImage" accept="image/*">
                    <div class="type">
                        <i class="fa fa-photo" aria-hidden="true"></i>
                        <label>Imagen</label>
                    </div>
                </div>
            </div>

            <div class="input">
                <label>Promo</label>
                <input type="text" name="text" value="{{ old('text') }}" placeholder="Promo">
                <div class="focus"></div>
            </div>

            <button type="button" @click="saveWithSpinner($refs.createForm)">Done</button>

        </form>


    </div>

    <panel-change-view view="edit_view"></panel-change-view>

    <panel-config :actions="['hideActions', 'hidePreview']"></panel-config>
@endsection
{{-- Seccion de Form --}}
