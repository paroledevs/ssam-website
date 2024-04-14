@extends('admin.menu.items')

{{-- Seccion de Form --}}
@section('form')
    <div class="formularios white" id="menu_form">

        <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data" ref="formCreate">
            @csrf

            <div class="fotos">
                <div class="foto">
                    <input type="file" name="cover" @change="setImage" accept="image/*">
                    <div class="type">
                        <i class="fa fa-image" aria-hidden="true"></i>
                        <label>Foto</label>
                    </div>
                </div>
            </div>

            <div class="input">
                <label>Categoría</label>
                <select name="category">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                <div class="focus"></div>
            </div>

            <div class="input">
                <label>Plato</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Plato">
                <div class="focus"></div>
            </div>

            <div class="input">
                <label>Descripción</label>
                <textarea name="description" placeholder="Descripción" rows="6">{{ old('description') }}</textarea>
                <div class="focus"></div>
            </div>

            <button type="button" @click="saveWithSpinner($refs.formCreate)">Done</button>

        </form>


    </div>


    <panel-change-view view="edit_view"></panel-change-view>

    <panel-config :actions="['hideActions', 'hidePreview']"></panel-config>
@endsection
{{-- Seccion de Form --}}
