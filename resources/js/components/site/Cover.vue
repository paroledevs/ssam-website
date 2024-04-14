<template>
	<div id="cover">
		<div id="fotos">
			<div  v-for="(photo,index) in photos" :key="index" :style="imgBackground(photo.cover)" :class="['foto',{active:current==index}]"></div>
			<div class="foto active" style="background: url('/images/sample.jpg')no-repeat center center;" v-if="!anyPhoto"></div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['photos'],
		data() {
			return {
				current:0,
				time:6000,
				timer: null,
			};
		},
		computed:{
			anyPhoto(){
				return this.photos.length > 0 ? true : false;	
			},
			totalPhotos(){
				return this.photos.length;	
			},
		},
		methods: {
			start(){
				
				this.timer = setInterval(()=>{
					
					if(this.current < (this.totalPhotos - 1)){
						this.current += 1;
					}else{
						this.current = 0;
					}
					
				},this.time);
				
			},
		},
		mounted() {
			
			if(this.anyPhoto){
				this.start();
			}
			
		},
	};
</script>