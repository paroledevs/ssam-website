@extends('admin.website.items')


{{-- Seccion View --}}
@section('preview')
    <div id="website_preview">

    </div>
@endsection
{{-- Seccion View --}}


{{-- Seccion de Form --}}
@section('form')
    <div class="formularios" id="website_form">


        <div class="seccion">
            <h6>Paquetes</h6>
            <div class="content">

                <form action="{{ route('website.catering.store') }}" method="POST" enctype="multipart/form-data" ref="formEdit">
                    @csrf

                    <div class="input">
                        <label>Paquete</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Paquete">
                        <div class="focus"></div>
                    </div>

                    <div class="input">
                        <label>Descripción</label>
                        <textarea name="description" placeholder="Descripción" rows="4">{{ old('description') }}</textarea>
                        <div class="focus"></div>
                    </div>


                    <button type="button" @click="saveWithSpinner($refs.formEdit)">Añadir</button>

                </form>


                <div class="bloques" id="paquetes">

                    @foreach ($caterings as $catering)
                        <div class="bloque paquete">
                            <div class="preview">
                                <strong>{{ $catering->title }}</strong>
                                <span>{{ $catering->description }}</span>
                            </div>
                            <div class="actions">
                                <div class="action del" v-on:click="requestViaForm('{{ route('website.catering.destroy', compact('catering')) }}', 'DELETE', null, '¿Eliminar Paquete?')">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>


            </div>
        </div>



    </div>

    <panel-change-view view="edit_view"></panel-change-view>

    <panel-config :actions="['hideActionDelete', 'hidePreview']"></panel-config>

    <panel-live-view-item live-route="{{ route('site.catering') }}"></panel-live-view-item>
@endsection
{{-- Seccion de Form --}}

@push('scripts')
    <script></script>
@endpush
