<template>

	<!-- @click="emitGlobalEvent('openPhoto',{index:{{ $image->id }},comp_ide:'ide'})" -->

	<div id="photoView" :class="{showed : show}"  tabindex="0">
		<input type="text" ref="navinput" id="navinput" @keydown.39="nextPhoto" @keydown.37="prevPhoto">
		
		<div id="cerrador" @click="close"></div>
			
		<div id="photo" :style="main ? imgBackground(main.url) : ''">
			<div id="close" @click="close">
				<span>Cerrar</span>
			</div>
			<div class="side" id="next"  :class="{off: !next}"><div class="arrow" @click="nextPhoto"><i class="fa fa-caret-right" aria-hidden="true"></i></div></div>
			<div class="side" id="prev"  :class="{off: !prev}"><div class="arrow" @click="prevPhoto"><i class="fa fa-caret-left" aria-hidden="true"></i></div></div>
		</div>

	</div>

</template>

<script>
export default {
	props: ['photos','ide'],
		data () {
			return {
				current: 0,
				prev: null,
				main: null,
				next: null,
				show: false,
			}
		},
		methods: {
			
			navigate(event){
				
				if(event.keyCode == 39){
					this.nextPhoto();
				}
				
				if(event.keyCode == 37){
					this.prevPhoto();
				}
			},

			nextPhoto() {
				if(this.next){
					this.setPhoto(this.next.id);
				}
				this.focusInput();
			},

			prevPhoto() {
				if(this.prev){
					this.setPhoto(this.prev.id);
				}
				this.focusInput();
			},

			setPhoto(photoid){
				
				
				this.current = _.findIndex(this.photos,['id',photoid]);

				this.main = this.current >= 0 ? this.photos[this.current] : null;

				if(this.photos[this.current - 1]){
					this.prev = this.photos[this.current - 1];
				}else{
					this.prev = null;
				}


				if(this.photos[this.current + 1]){
					this.next = this.photos[this.current + 1];
				}else{
					this.next = null;
				}


				this.focusInput();

			},

			close(){

				this.show = false;

			},
			
			focusInput() {
		    	this.$refs.navinput.focus();
		    },
		    
		    open({index,comp_ide}){
			    
			    
			    if(comp_ide == this.ide){
				    
				    this.show = true;
				    this.setPhoto(index);
				    
			    }
			    
		    },


		},
		

		mounted () {

			this.listenGlobalEvent('openPhoto',this.open);
			this.focusInput();

		}
}
</script>