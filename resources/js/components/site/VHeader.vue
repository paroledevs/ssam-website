<template>
	<header :class="[{white:white},{menu:menu}]">
	
		<div id="header">
			<div class="centrador">
				
				<div id="logo">
					<a href="/">
					<v-svg choose="ssam" clase="logo"></v-svg>
					</a>
				</div>
				
				<div id="cerrador" :class="{active:menu}" @click="closeMenu"></div>
				
				<div id="menu">
					<menu>
					<div class="link"><a href="https://tienda.ssam.mx/"><span>Tienda</span></a></div>
						<div class="link"><a :href="route('site.menu')"><span>Menú</span></a></div>
						<div class="link"><a :href="route('site.book')"><span>Reserva</span></a></div>
						<div class="link"><a :href="route('site.blog')"><span>Recetas</span></a></div>
<!-- 						<div class="link"><a :href="route('site.catering')"><span>Catering</span></a></div> -->
						<div class="link"><a :href="route('site.us')"><span>Nosotros</span></a></div>
						<div id="social">
							<div class="rrss"><a href="https://www.instagram.com/restaurantessam/"><v-svg choose="ig" clase="ico"></v-svg></a></div>
							<div class="rrss"><a href="https://www.tiktok.com/@restaurantessam"><v-svg choose="tk" clase="ico"></v-svg></a></div>
						</div>
					</menu>
				</div>
				
				<div id="actions">
					<div class="action" id="btnMenu" @click="showMenu">
						<v-svg choose="menu" clase="ico"></v-svg>
					</div>
				</div>
				
				
			</div>
		</div>
		
	</header>
</template>

<script>

	export default {
		props: ['path'],
		data() {
			return {
				menu: false,
				promo: false,
				scroll: true,
				scrolltop: 0,
				white: false,
			};
		},
		methods: {
			showMenu() {
				if (!this.menu) {
					this.menu = true;
				} else {
					this.menu = false;
				}
			},

			closeMenu() {
				this.menu = false;
			},


		},
		mounted() {
			window.addEventListener('scroll', (e)=> {
			
				this.scrolltop = window.scrollY;
				
				if(this.scrolltop > 10){
					this.scroll = false;
				}else{
					this.scroll = true;
				}
				
				
			});
			
			window.addEventListener('wheel', (event)=> {

			    if (event.deltaY >= 0) {

			        //SCROLL DOWN

			    }

			});
			
			
			if(this.path=='/'){
				this.white = true;
			}
			
			if(this.path.startsWith('menu') || this.path=='nosotros' || this.path=='catering' || this.path.startsWith('recetas/')){
				
				if(window.innerWidth > 430){
					this.white = true;
				}
				
			}
			
		},
	};
</script>
