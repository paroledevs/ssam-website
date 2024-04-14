@extends('layouts.default')

@section('title','Nosotros | SSAM Restaurante Coreano')

@section('metas')

   	<meta property="og:url" content="{{ Request::url() }}"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="SSAM"/>
	<meta property="og:image" content="{{ asset('images/meta_img.jpg') }}"/>
	<meta property="og:description" content="Restaurante Coreano"/>
	<meta property="fb:app_id" content=""/>

@endsection


@section('content')

    <div id="us">
	    
		
        <v-header path="{{ Request::path() }}"></v-header>
        
        <div id="portada" class="title">
	        <div class="blurfoto active" style="background: url('/images/jpg/us.jpg')no-repeat center center;"></div>
	        <div class="blurcolor"></div>
	        <div class="centrador">
		        <div class="centro">
			        <h2>Nosotros.</h2>
		        </div>
	        </div>
        </div>
        
        <main>
	    
	        
	        
	        <section class="texto">
		        <div class="centrador">
			        <div class="parrafos">
				        <div class="parrafo full">
					        <div class="centro">
						        <h6>Cómo empezó todo</h6>
						        <p class="paragraph">SSAM nace en 2014 como una propuesta de desayunos mexicanos y comida corrida, sin embargo, a los 6 meses de la apertura se incluyó en el menú el primer platillo coreano y tuvo tal éxito que la gente comenzó a pedirlo cada vez más.

Con el paso del tiempo, se ofreció comida mexicana por las mañanas y coreana por las tardes, pues los clientes ya se habían enamorado de los sabores de esta gastronomía. 

Finalmente, dos años después de la creación del restaurante el concepto cambió totalmente a como lo conocemos ahora, ofreciendo comida coreana en un ambiente moderno y acogedor.

Hoy, somos una gran comunidad formada por nuestros colaboradores, clientes y proveedores, todos juntos somos SSAM.</p>
							</div>
				        </div>
			        </div>
		        </div>
	        </section>
	        
	        
	        <section class="photo">
		        <div class="centrador">
			        <div class="fotos">
				        <div class="foto full">
					        <img src="/images/jpg/us1.jpg">
				        </div>
			        </div>
		        </div>
	        </section>
	        
	        
	        <section class="texto">
		        <div class="centrador">
			        <div class="parrafos">
				        <div class="parrafo">
					        <div class="centro">
					        	<h6>Su</h6>
								<p class="paragraph">Originaria de Jecheon, Corea del Sur. Joven emprendedora, dueña de la colección de restaurantes coreanos más reconocidos de Guadalajara.

Sujin Lee es una mujer apasionada por compartir la gastronomía y cultura de su país de origen, mismo sueño que ha trasladado a su modelo de empresa, donde el propósito es la globalización de la comida coreana creando experiencias gastronómicas inolvidables.
 
Además de su labor como empresaria, Sujin Lee está presente en la red social Instagram como Su.de.ssam en donde comparte su día a día como coreana, mamá y experta de comida con el mismo principio que ha transmitido a sus restaurantes, donde representa a su cultura y ha generado una gran comunidad.</p>
							</div>
				        </div>
				        <div class="parrafo">
					        <div class="centro">
					        	<h6>César</h6>
					        	<p class="paragraph">Originario de Guadalajara Jalisco, licenciado en administración de restaurantes por la Universidad Anáhuac y cocinero de profesión.

Junto a Sujin creó el menú y estructura operativa de la colección de restaurantes SSAM.

Actualmente César Cárdenas está al frente de la dirección de SSAM, donde en conjunto con el equipo buscan crear experiencias gastronómicas inolvidables, expansión de marca y contribuir al desarrollo personal y profesional de sus colaboradores.</p>
							</div>
				        </div>
			        </div>
		        </div>
	        </section>
	        
	        
	        <section class="photo">
		        <div class="centrador">
			        <div class="fotos">
				        <div class="foto full">
					        <img src="/images/jpg/us2.jpg">
				        </div>
			        </div>
		        </div>
	        </section>
	        
	        
	        <section class="texto">
		        <div class="centrador">
			        <div class="parrafos">
				        <div class="parrafo full">
					        <div class="centro">
					        	<h6>Nuestra comida</h6>
								<p class="paragraph">Somos una colaboración de dos restauranteros y chefs, César Cárdenas y Sujin Lee, juntos con el gran sueño de globalizar la gastronomía coreana creamos la primera sucursal en la calle José María Morelos, colonia Ladrón de Guevara, Jalisco.

En 2022, SSAM fue posicionado como el número uno elegido por los usuarios de la plataforma internacional Tripadvisor.

Cocinamos con amor por la tradición coreana, siempre con un alto enfoque en la innovación y la calidad de los alimentos, desde la selección de los ingredientes hasta que llevamos los platos a tu mesa.

Deja que la calidez de un Ramyeon, la explosión de sabores de un Bibimbap o los condimentos del Kimchi te regalen un pedacito de Corea.</p>
							</div>
				        </div>
			        </div>
		        </div>
	        </section>
	        
	        
	        
	        <section class="photo">
		        <div class="centrador">
			        <div class="fotos">
				        <div class="foto">
					        <div class="blurfoto" style="background: url('/images/jpg/us3.jpg')no-repeat center center;"></div>
				        </div>
				        <div class="foto">
					        <div class="blurfoto" style="background: url('/images/jpg/us4.jpg')no-repeat center center;"></div>
				        </div>
			        </div>
		        </div>
	        </section>
	
	        
        </main>
        

    </div>

@endsection

