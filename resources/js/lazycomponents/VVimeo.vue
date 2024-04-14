<template>
	<div class="video">
		<div class="blurcolor" v-if="!playing"></div>
		<div class="ico play" v-if="!playing" @click="start">
			<i class="fa fa-play" aria-hidden="true"></i>
		</div>
		<div id="embed">
			<vue-vimeo-player ref="player" :video-id="video" @play="running" @pause="stopping"></vue-vimeo-player>
		</div>
	</div>
</template>

<script>
	import { vueVimeoPlayer } from 'vue-vimeo-player';

	export default {
		props: ['video'],
		data() {
			return {
				playing:false,
			};
		},
		components: { vueVimeoPlayer },
		computed: {
			
		},

		methods: {
			
			running(){
				this.playing = true;
			},
			
			stopping(){
				this.playing = false;
			},
			
			start(){
				this.$refs.player.play();
			},
			
		},

		mounted() {

			
		},
	};
</script>



