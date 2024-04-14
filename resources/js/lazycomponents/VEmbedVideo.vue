<template>
	
	<div class="video" v-if="show">
		
		<img :src='"https://img.youtube.com/vi/" + videoid + "/maxresdefault.jpg"' v-if="medio == 'youtube' && !playing" >
		<img :src='"https://vumbnail.com/" + videoid + ".jpg"' v-if="medio == 'vimeo' && !playing">
		
		<div class="ico play" @click="playing = true"  v-if="!playing">
			<i class="fa fa-play" aria-hidden="true"></i>
		</div>
		
		<div class="embed" v-if="medio == 'youtube' && playing">
			<iframe width="100%" :src="'https://www.youtube.com/embed/' + videoid" frameborder="0" allow="accelerometer;encrypted-media;gyroscope;"></iframe>
		</div>
		
		<div class="embed" v-if="medio == 'vimeo' && playing">
			<iframe :src="'https://player.vimeo.com/video/' + videoid + '?color=527FBE&title=0&byline=0&portrait=0'" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%" frameborder="0"></iframe>
		</div>
		
	</div>

</template>

<script>
export default {
	props: ['url'],
	data(){
		return {
			videoid: null,
			medio: null,
			playing: false,
			show:false,
		};
	},	
	methods: {
		
		initUrl(){
			var matches = this.url.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
			if(matches && matches[1]){
				
				if(matches[1] == 'www.youtube.com' || matches[1] == 'youtube.com'){
					return 'youtube';
				}else if(matches[1] == 'www.vimeo.com' || matches[1] == 'vimeo.com'){
					return 'vimeo';
				}else{
					return matches[1];
				}
				
				
			}else{
				return null;
			}
		},
		
		getYoutubeID(url){
		    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		    var match = url.match(regExp);
		    return match ? match[7] : null;
		},	
		
		getVimeoID(url){
			var regExp = /https:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
			var match = url.match(regExp);
			return match ? match[2] : null;
		},
			
	},
	mounted(){
		

		this.medio = this.initUrl();
		
		if(this.medio=='youtube'){
			this.videoid = this.getYoutubeID(this.url);
		}
		
		if(this.medio=='vimeo'){
			this.videoid = this.getVimeoID(this.url)
		}
		
		if(this.medio && this.videoid){
			this.show = true;
		}

		
	},
}
</script>

