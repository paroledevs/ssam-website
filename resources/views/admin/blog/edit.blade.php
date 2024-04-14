@extends('admin.blog.items')


{{-- Seccion View --}}
@section('preview')
    <div id="blog_preview">

    </div>
@endsection
{{-- Seccion View --}}


{{-- Seccion de Form --}}
@section('form')
    <div class="formularios" id="blog_form">

        <div class="seccion">
            <h6>{{ $post->title }}</h6>
            <div class="content">

                <div v-if="editing">
                    <form action="{{ route('posts.update', compact('post')) }}" method="POST" enctype="multipart/form-data" ref="formEdit">
                        @csrf
                        @method('PUT')


                        <div class="fotos" id="image">
                            <div class="foto" :style="imgBackground('{{ $post->mainImage }}')">
                                <input type="file" name="main_image" @change="setImage" accept="image/*">
                                <div class="type">
                                    <i class="fa fa-image" aria-hidden="true"></i>
                                    <label>Post image</label>
                                </div>
                            </div>
                        </div>

                        <div class="fotos" id="cover">
                            <div class="foto" :style="imgBackground('{{ $post->cover }}')">
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
                                    <option value="{{ $category->id }}" @selected($category->id === $post->category->id)>{{ $category->title }}</option>
                                @endforeach
                            </select>
                            <div class="focus"></div>
                        </div>

                        <div class="input">
                            <label>Plato</label>
                            <input type="text" name="title" value="{{ old('title', $post) }}" placeholder="Plato">
                            <div class="focus"></div>
                        </div>

                        <div class="input">
                            <label>Descripción</label>
                            <textarea name="description" placeholder="Descripción" rows="3">{{ old('description', $post) }}</textarea>
                            <div class="focus"></div>
                        </div>

                        <div class="input">
                            <label>Estado</label>
                            <select name="visibility">
                                <option value="everyone" @selected($post->isVisibleFor('everyone'))>Visible</option>
                                <option value="no_one" @selected($post->isVisibleFor('no_one'))>Oculta</option>
                            </select>
                            <div class="focus"></div>
                        </div>


                        <button type="button" @click="saveWithSpinner($refs.formEdit)">Done</button>

                    </form>
                </div>

                <button type="button" v-if="!editing" @click="editing = true">Update post info</button>

            </div>
        </div>


        <div class="seccion">
            <h6>Procedimiento</h6>
            <div class="content">

                <blocks :routes="{{ json_encode($post->blockRoutes()) }}" :post-id="{{ $post->id }}"></blocks>

            </div>
        </div>


        <div class="seccion">
            <h6>Galería</h6>
            <div class="content">

                <v-gallery label="Imagen" format="double" :parent-id="{{ $post->id }}" parent-name="post"></v-gallery>

            </div>
        </div>



    </div>

    <panel-change-view view="edit_view"></panel-change-view>

    <panel-config :actions="['hidePreview']"></panel-config>

    <panel-delete-item message="Delete this post?" delete-route="{{ route('posts.destroy', compact('post')) }}"></panel-delete-item>

    <panel-live-view-item live-route="{{ route('site.post', compact('post')) }}"></panel-live-view-item>
@endsection
{{-- Seccion de Form --}}
