@extends('admin.blog.items')

{{-- Seccion de Form --}}
@section('form')
    <div class="formularios white" id="blog_form">

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" ref="formCreate">
            @csrf

            <div class="fotos" id="image">
                <div class="foto">
                    <input type="file" name="main_image" @change="setImage" accept="image/*">
                    <div class="type">
                        <i class="fa fa-image" aria-hidden="true"></i>
                        <label>Post image</label>
                    </div>
                </div>
            </div>

            <div class="fotos" id="cover">
                <div class="foto">
                    <input type="file" name="cover" @change="setImage" accept="image/*">
                    <div class="type">
                        <i class="fa fa-image" aria-hidden="true"></i>
                        <label>Cover</label>
                    </div>
                </div>
            </div>

            <div class="input">
                <label>Categoría</label>
                <select name="postCategory">
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
                <label>Description</label>
                <textarea name="description" placeholder="Description" rows="3">{{ old('description') }}</textarea>
                <div class="focus"></div>
            </div>

            <div class="input">
                <label>Estado</label>
                <select name="visibility">
                    <option value="everyone">Visible</option>
                    <option value="no_one">Oculta</option>
                </select>
                <div class="focus"></div>
            </div>


            <button type="button" @click="saveWithSpinner($refs.formCreate)">Done</button>

        </form>


    </div>

    <panel-change-view view="edit_view"></panel-change-view>

    <panel-config :actions="['hideActions', 'hidePreview']"></panel-config>
@endsection
{{-- Seccion de Form --}}
