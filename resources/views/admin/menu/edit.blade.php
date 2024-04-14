@extends('admin.menu.items')


{{-- Seccion View --}}
@section('preview')
    <div id="menu_preview">

    </div>
@endsection
{{-- Seccion View --}}


{{-- Seccion de Form --}}
@section('form')
    <div class="formularios white" id="menu_form">

        <form action="{{ route('menu.update', compact('dish')) }}" method="POST" enctype="multipart/form-data" ref="formEdit">
            @csrf
            @method('PUT')

            <div class="fotos">
                <div class="foto" :style="imgBackground('{{ $dish->cover }}')">
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
                        <option value="{{ $category->id }}" @selected($category->id === $dish->category->id)>{{ $category->title }}</option>
                    @endforeach
                </select>
                <div class="focus"></div>
            </div>

            <div class="input">
                <label>Plato</label>
                <input type="text" name="title" value="{{ old('title', $dish) }}" placeholder="Plato">
                <div class="focus"></div>
            </div>

            <div class="input">
                <label>Descripción</label>
                <textarea name="description" placeholder="Descripción" rows="6">{{ old('description', $dish) }}</textarea>
                <div class="focus"></div>
            </div>

            <div class="input check">
                <input type="hidden" name="show_in_menu" value="0">
                <input type="checkbox" name="show_in_menu" value="1" @checked($dish->show_in_menu)>
                <div class="checkbox">
                    <i class="fa fa-check" aria-hidden="true"></i>
                </div>
                <label>Mostrar en Menu</label>
            </div>


            <button type="button" @click="saveWithSpinner($refs.formEdit)">Done</button>

        </form>



    </div>


    <panel-change-view view="edit_view"></panel-change-view>

    <panel-config :actions="['hideActionShow', 'hidePreview']"></panel-config>

    <panel-delete-item message="Delete this plate?" delete-route="{{ route('menu.destroy', compact('dish')) }}"></panel-delete-item>
@endsection
{{-- Seccion de Form --}}
