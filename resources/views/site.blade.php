@extends('layouts.default')

@section('title','Planetoide.mx')

@section('metas')

   	<meta property="og:url" content="{{ Request::url() }}"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="Planetoide.mx"/>
	<meta property="og:image" content="{{ asset('images/meta_img.jpg') }}"/>
	<meta property="og:description" content=""/>
	<meta property="fb:app_id" content=""/>

@endsection


@section('content')

    <div id="site">

        <app></app>

    </div>

@endsection


@push('scripts')

	<script>
        {{-- Si no habrá scripts eliminar este @push  --}}
	</script>

@endpush