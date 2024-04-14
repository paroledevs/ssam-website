<template>
	<div id="portada">
		<div  v-for="(promo,index) in promos" :key="index" :style="imgBackground(promo.cover)" :class="['blurfoto',{active:current==index}]"></div>
	    <div class="blurfoto active" style="background: url('/images/jpg/menu.jpg')no-repeat center center;" v-if="!anyPromo"></div>
	    <div class="blurcolor"></div>
	    <div class="centrador">
	        <div class="centro">
	        	<h2>Menú.</h2>
				<span v-if="anyPromo">{{ promos[current].link }}</span>
	        </div>
	    </div>
    </div>
</template>

<script>
	export default {
		props: ['promos'],
		data() {
			return {
				current:0,
				time:6000,
				timer: null,
			};
		},
		computed:{
			anyPromo(){
				return this.promos.length > 0 ? true : false;	
			},
			totalPromos(){
				return this.promos.length;	
			},
		},
		methods: {
			start(){
				
				this.timer = setInterval(()=>{
					
					if(this.current < (this.totalPromos - 1)){
						this.current += 1;
					}else{
						this.current = 0;
					}
					
				},this.time);
				
			},
		},
		mounted() {
			
			if(this.anyPromo){
				this.start();
			}
			
		},
	};
</script>