@extends('admin.monitor.items')


{{-- Seccion View --}}

@section('preview')

<div id="monitor_preview">



    <div class="seccion">
        <h6>{{ $activity->created_at->format('d/m/Y - h:m a') }}</h6>
        <div class="content" id="accion">

            @if ($activity->causedBy)

            <div id="administrador">
                <div class="avatar" :style="imgBackground('{{ $activity->causedBy->avatar }}')"></div>
                <div class="texto">
                    <strong>{{ $activity->causedBy->name }}</strong>
                </div>
            </div>

            @endif

            <div id="descripcion">
                <span>{{ $activity->description }}</span>
            </div>

        </div>
    </div>


    <div class="seccion">
        <h6>Detalles</h6>
        <div class="content">

            <div class="contenido" id="detalles">
                <div class="info">
                    <label>Objeto</label>
                    <p>{{ $activity->performed_on_model }} - {{ $activity->performed_on_class }}</p>
                </div>
                <div class="info">
                    <label>Action</label>
                    <p>{{ $activity->action }}</p>
                </div>
                <div class="info">
                    <label>URL</label>
                    <p>{{ $activity->url }}</p>
                </div>
                <div class="info">
                    <label>Metodo</label>
                    <p>{{ $activity->method }}</p>
                </div>
                <div class="info">
                    <label>IP</label>
                    <p>{{ $activity->ip }}</p>
                </div>
                <div class="info">
                    <label>Navegador</label>
                    <p>{{ $activity->agent }}</p>
                </div>
                <div class="info">
                    <label>Consulta</label>
                    <p>{{ $activity->payload }}</p>
                </div>
            </div>

        </div>
    </div>





</div>

@endsection

{{-- Seccion View --}}



{{-- Seccion de Form --}}

@section('form')

<div class="formularios" id="monitor_form">


</div>

<panel-change-view view="preview"></panel-change-view>

<panel-config :actions="['hideActions', 'hideEdit']"></panel-config>

@endsection
{{-- Seccion de Form --}}
