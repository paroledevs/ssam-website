@extends('admin.locations.items')


{{-- Seccion View --}}
@section('preview')
    <div id="location_preview">

    </div>
@endsection
{{-- Seccion View --}}


{{-- Seccion de Form --}}
@section('form')
    <div class="formularios white" id="location_form">

        <form action="{{ route('locations.update', compact('location')) }}" method="POST" enctype="multipart/form-data" ref="formEdit">
            @csrf
            @method('PUT')


            <div class="fotos">
                <div class="foto" :style="imgBackground('{{ $location->cover }}')">
                    <input type="file" name="cover" @change="setImage" accept="image/*">
                    <div class="type">
                        <i class="fa fa-image" aria-hidden="true"></i>
                        <label>Foto</label>
                    </div>
                </div>
            </div>


            <div class="input">
                <label>Sucursal</label>
                <input type="text" name="name" value="{{ old('name', $location) }}" placeholder="Sucursal">
                <div class="focus"></div>
            </div>

            <div class="input">
                <label>Dirección</label>
                <textarea name="address" placeholder="Dirección" rows="3">{{ old('address', $location) }}</textarea>
                <div class="focus"></div>
            </div>

            <div class="input">
                <label>Horarios</label>
                <textarea name="timetable" placeholder="Horarios" rows="3">{{ old('timetable', $location) }}</textarea>
                <div class="focus"></div>
            </div>

            <div class="input">
                <label>Contacto</label>
                <textarea name="contact" placeholder="Contacto" rows="3">{{ old('contact', $location) }}</textarea>
                <div class="focus"></div>
            </div>

            <div class="input placeholder">
                <label>Link</label>
                <input type="text" name="link" value="{{ old('link', $location) }}" placeholder="tel:########## o https://wa.me/1XXXXXXXXXX">
                <div class="focus"></div>
            </div>


			<div class="input">
				<label>Reserva</label>
				<input type="text" name="book" value="{{ old('book', $location) }}">
				<div class="focus"></div>
			</div>

            <button type="button" @click="saveWithSpinner($refs.formEdit)">Done</button>

        </form>



    </div>


    <panel-change-view view="edit_view"></panel-change-view>

    <panel-config :actions="['hidePreview', 'hideActionShow']"></panel-config>

    <panel-delete-item message="Delete this location?" delete-route="{{ route('locations.destroy', compact('location')) }}"></panel-delete-item>
@endsection
{{-- Seccion de Form --}}
