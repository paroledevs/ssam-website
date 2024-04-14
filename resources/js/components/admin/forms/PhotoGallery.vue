<template>
	<div class="photoGallery">
		
		<div class="photos">
			
			<div class="photo" v-for="(image,index) in images" :key="index" :class="{active: current == index}" :style="imgBackground(image)"></div>
			<div class="nav prev" @click="prev">
				<div class="arrow">
					<i class="fa fa-caret-left" aria-hidden="true"></i>
				</div>
			</div>
			<div class="nav next" @click="next">
				<div class="arrow">
					<i class="fa fa-caret-right" aria-hidden="true"></i>
				</div>
			</div>
		</div>
		<div class="thumbs" :class="format">
			<div class="thumb" v-for="(image,index) in images" :key="index" :class="{active: current == index}" @click="current=index"></div>
		</div>
		
	</div>
</template>
<script>
	export default {
		props: ['images','format'],
		data() {
			return {
				current: 0,
			};
		},
		computed:{
			
			totalImages(){
				return this.images ? this.images.length : 0;
			}	
		},
		methods: {

			prev(){
				
				if(this.current>0){
					this.current -= 1;
				}
			},
			
			next(){
				if(this.current<this.totalImages){
					this.current += 1;
				}
			},
			
		},

		mounted() {
			
		},
	};
</script>
