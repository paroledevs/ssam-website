{{--===========================================================--}}
{{--================== Seccion de items =======================--}}
{{--===========================================================--}}

@section('items')


{{-- Filtros con componente de Vue --}}
<admin-filters base-url="{{ route('') }}" :options="{}" disabled-option="" :is-collection="true | false"
	prop-to-show="solo si is-collection es true" prop-to-use="solo si is-collection es true" filter-name="" all-text=""
	link-key="" init-value="{{ request()->query('') }}">
</admin-filters>


{{-- Item nuevo --}}
<a href="{{ route('') }}">
	<div class="item _item new">
		<label>Nuevo</label>
	</div>
</a>


{{-- Items sin búsqueda instantánea --}}
@foreach ()

<a href="{{ route() }}">
	<div class="item _item off highlight">

		<div class="foto"></div>
		<div class="texto">
			<strong></strong>
			<span></span>
		</div>

	</div>
</a>

@endforeach



{{-- Paginado (Load More) --}}

<div class="item _item more">
	<label>Cargar más</label>
</div>


{{-- Paginado (Prev, Next) COMPONENTE --}}



@endsection




{{--===========================================================--}}
{{--================== Seccion de edit ========================--}}
{{--===========================================================--}}


@section('form')


	{{-- SECCIONES DE CONTENIDO (SOLO FORMULARIOS SECCIONADOS) --}}
	<div class="seccion">
		<h6>Nombre de la sección</h6>
		<div class="content">

			FORM AQUI

		</div>
	</div>


	{{-- PARA GRUPO DE FOTOS QUE SE SELECCIONAN INDEPENDIENTES --}}
	<div class="fotos">
		<div class="foto">
			<input type="file" name="image" @change="setImage" accept="image/*">
			<div class="type">
				<i class="fa fa-image" aria-hidden="true"></i>
				<label>Etiqueta</label>
			</div>
		</div>
	</div>

	{{-- VIDEOS O ARCHIVOS --}}
	<div class="archivos">
		<div class="archivo">
			<input type="file" name="video" @change="setFile" />
			<input type="hidden" name="" value="" />
			<div class="type">
				<i class="fa fa-file" aria-hidden="true"></i>
				<label>Etiqueta</label>
			</div>
		</div>
	</div>

	{{-- INPUT COMUN --}}
	<div class="input">
		<label>campo</label>
		<input type="text" name="" placeholder="">
		<div class="focus"></div>
	</div>


	{{-- Textarea --}}
	<div class="input">
		<label>campo</label>
		<textarea name="" placeholder=""></textarea>
		<div class="focus"></div>
	</div>


	{{-- Tags Input --}}
	<v-tags label="Label" input-name="" :tags-autocomplete="[]" :placeholder="'Enter'" :max-tags="" :init-tags="[]"></v-tags>


	{{-- Select --}}
	<div class="input">
		<label>Selecciona</label>
		<select name="">
			<option selected disabled>Selecciona ...</option>
			@foreach ($valores as $valor)
			<option value="{{ valor }}">{{ nombre }}</option>
			@endforeach
		</select>
		<div class="focus"></div>
	</div>

	{{-- Checkbox --}}
	<div class="input check">
		<input type="hidden" name="" value="0">
		<input type="checkbox" name="" value="1" @if(true) checked @endif>
		<div class="checkbox">
			<i class="fa fa-check" aria-hidden="true"></i>
		</div>
		<label>campo</label>
	</div>


	{{-- GALERIA DE FOTOS (SELECCION MULTIPLE) CON MINIATURAS --}}
	<v-gallery label="" format="single" :reorder="false" :for-products="false" :routes="[]"></v-gallery>


	{{-- BOTON SIMPLE --}}
	<button type="button" @click="saveWithSpinner($refs.formName)">Terminé</button>
	<button type="button" class="del" >Eliminar</button>

	{{-- BOTONES MULTIPLES EN LINEA --}}
	<div class="acciones">
		<button type="button" @click="saveWithSpinner($refs.formName)">Guardar</button>
		<button type="button" class="del">Cancelar</button>
	</div>


@endsection


{{--===========================================================--}}
{{--================== Seccion de preview =====================--}}
{{--===========================================================--}}

@section('preview')


	{{-- SECCIONES DE CONTENIDO (SOLO CONTENIDO SECCIONADO) --}}
	<div class="seccion">
		<h6>Nombre de la sección</h6>
		<div class="content">

			CONTENIDO AQUI

		</div>
	</div>

	{{-- FOTOS EN LINEA --}}
	<div class="fotos">
		<div class="foto" :style="imgBackground('{{ imagen_aquí }}')"></div>
	</div>

	{{-- FOTO GRANDE --}}
	<div class="foto" :style="imgBackground('{{ imagen_aquí }}')"></div>

	{{-- Contenedor de Campos --}}
	<div class="contenido">
		<div class="info">
			<label>Campo</label>
			<p>{{ Texto }}</p>
		</div>
		<div class="info">
			<label>Campo</label>
			<p>{{ Texto }}</p>
		</div>
	</div>

	{{-- Campos independientes --}}
	<div class="info">
		<label>Campo</label>
		<p>{{ Texto }} <u>{{ Texto Resaltado }}</u> </p>
	</div>



@endsection



{{--===========================================================--}}
{{--================== Seccion de scripts =====================--}}
{{--===========================================================--}}

<panel-change-view view="preview|edit_view"></panel-change-view>

{{-- Config items --}}
<panel-config :actions="['hideFilters', 'hideSearch']"></panel-config>

{{-- Config create --}}
<panel-config :actions="['hideActions', 'hidePreview']"></panel-config>

{{-- Config edit --}}
<panel-config :actions="['hideActionDelete', 'hideActionShow', 'hideActions', 'hidePreview']"></panel-config>

{{-- Config preview only --}}
<panel-config :actions="['hideActionDelete', 'hideActionShow', 'hideActions', 'hideEdit']"></panel-config>

{{-- Delete item --}}
<panel-delete-item message="Delete this layout?" delete-route="{{-- {{ route('models.destroy', compact('model')) }} --}}"></panel-delete-item>

{{-- Live view item --}}
<panel-live-view-item live-route="{{-- {{ route('site.', compact('model')) }} --}}"></panel-live-view-item>


