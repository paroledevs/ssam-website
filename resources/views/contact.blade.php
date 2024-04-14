@extends('layouts.default')

@section('title','Solicitud de Catering | SSAM Restaurante Coreano')

@section('metas')

   	<meta property="og:url" content="{{ Request::url() }}"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="SSAM"/>
	<meta property="og:image" content="{{ asset('images/meta_img.jpg') }}"/>
	<meta property="og:description" content="Restaurante Coreano"/>
	<meta property="fb:app_id" content=""/>

@endsection


@section('content')

    <div id="contact">
	    
		
		<v-header path="{{ Request::path() }}"></v-header>
        
		
		<main>
	    
		    <div id="title">
			    <h2>Catering.</h2>
		    </div>
		    
		    <section id="solicitud">
			    <div class="centrador">
				    
				    <Contacto></Contacto>
				    
			    </div>
		    </section>
		    
		    
		</main>
        

    </div>

@endsection

