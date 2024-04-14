@extends('admin.locations.items')

{{-- Seccion de Form --}}
@section('form')
    <div class="formularios white" id="location_form">

        <form action="{{ route('locations.store') }}" method="POST" enctype="multipart/form-data" ref="formCreate">
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
                <label>Sucursal</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Sucursal">
                <div class="focus"></div>
            </div>

            <div class="input">
                <label>Dirección</label>
                <textarea name="address" placeholder="Dirección" rows="3">{{ old('address') }}</textarea>
                <div class="focus"></div>
            </div>

            <div class="input">
                <label>Horarios</label>
                <textarea name="timetable" placeholder="Horarios" rows="3">{{ old('timetable') }}</textarea>
                <div class="focus"></div>
            </div>

            <div class="input">
                <label>Contacto</label>
                <textarea name="contact" placeholder="Contacto" rows="3">{{ old('contact') }}</textarea>
                <div class="focus"></div>
            </div>

            <div class="input placeholder">
                <label>Link</label>
                <input type="text" name="link" value="{{ old('link') }}" placeholder="tel:########## o https://wa.me/1XXXXXXXXXX">
                <div class="focus"></div>
            </div>

			<div class="input">
				<label>Reserva</label>
				<input type="text" name="book" value="{{ old('book') }}">
				<div class="focus"></div>
			</div>


            <button type="button" @click="saveWithSpinner($refs.formCreate)">Done</button>

        </form>


    </div>


    <panel-change-view view="edit_view"></panel-change-view>

    <panel-config :actions="['hideActions', 'hidePreview']"></panel-config>
@endsection
{{-- Seccion de Form --}}
