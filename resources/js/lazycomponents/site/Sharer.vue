<template>
	
	<div id="sharer">
		<div id="social" :class="{active:social}">
			<div class="action rrss" id="fb">
				<a :href="'https://www.facebook.com/sharer/sharer.php?u=' + url">
				<div class="ico">
					<i class="fa fa-facebook active" aria-hidden="true"></i>
				</div>
				</a>
			</div>
			<div class="action rrss" id="tw">
				<a :href="'https://twitter.com/intent/tweet?url=' + url">
				<div class="ico">
					<i class="fa fa-twitter active" aria-hidden="true"></i>
				</div>
				</a>
			</div>
		</div>
		<div class="action" id="btnShare" @click="social = !social">
			<div class="ico">
				<i class="fa fa-external-link" :class="{active:!social}"></i>
				<i class="fa fa-close" :class="{active:social}"></i>
			</div>
		</div>
		<div class="action" id="btnWA">
			<a :href="'https://api.whatsapp.com/send?text=' + url">
			<div class="ico">
				<i class="fa fa-whatsapp active" aria-hidden="true"></i>
			</div>
			</a>
		</div>
	</div>

</template>

<script>
export default {
	props: ['url'],
	data(){
		return {
			social: false,
		};
	},

	methods: {
		
		
			
	},
	mounted(){
		
	},
}
</script>

