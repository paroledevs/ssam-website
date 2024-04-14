@extends('layouts.default')


@section('title','SSAM - Restaurante Coreano')

@section('metas')

   	<meta property="og:url" content="{{ Request::url() }}"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="SSAM"/>
	<meta property="og:image" content="{{ asset('images/meta_img.jpg') }}"/>
	<meta property="og:description" content="Restaurante Coreano"/>
	<meta property="fb:app_id" content=""/>

@endsection


@section('content')

    <div id="site">


        <v-header path="{{ Request::path() }}"></v-header>

        <Cover :photos="{{ Js::from($covers ?? []) }}"></Cover>


    </div>

@endsection
