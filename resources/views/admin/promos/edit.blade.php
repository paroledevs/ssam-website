@extends('admin.promos.items')


{{-- Seccion View --}}

@section('preview')
    <div id="promo_preview">

    </div>
@endsection

{{-- Seccion View --}}





{{-- Seccion de Form --}}

@section('form')
    <div class="formularios white" id="promo_form">

        <form action="{{ route('promos.update', compact('promo')) }}" method="POST" enctype="multipart/form-data" ref="updateForm">
            @csrf
            @method('PUT')

            <div class="fotos">
                <div class="foto" :style="imgBackground('{{ $promo->cover }}')">
                    <input type="file" name="cover" @change="setImage" accept="image/*">
                    <div class="type">
                        <i class="fa fa-image" aria-hidden="true"></i>
                        <label>Imagen</label>
                    </div>
                </div>
            </div>

            <div class="input">
                <label>Promo</label>
                <input type="text" name="text" value="{{ old('text', $promo) }}" placeholder="Promo">
            </div>

            <button type="button" @click="saveWithSpinner($refs.updateForm)">Done</button>

        </form>



    </div>

    <panel-change-view view="edit_view"></panel-change-view>

    <panel-config :actions="['hideActionShow', 'hidePreview']"></panel-config>

    <panel-delete-item message="Delete this highlight?" delete-route="{{ route('promos.destroy', compact('promo')) }}"></panel-delete-item>
@endsection
{{-- Seccion de Form --}}
