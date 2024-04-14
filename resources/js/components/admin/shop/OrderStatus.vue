<template>
	
	<div class="status" :class="status">
		<i v-for="(stat,index) in stats" :key="index" class="fa" :class="[stat.ico,{showed : stat.name == status}]" aria-hidden="true"></i>
	</div>	

</template>
<script>
	export default {
		props: ['status'],
		data() {
			return {
				stats: [
					{name:'ready',ico:'fa-clock-o'},
					{name:'paid',ico:'fa-check'},
					{name:'canceled',ico:'fa-close'},
					{name:'shipped',ico:'fa-truck'},
				],
			};
		},
		computed: {
			
		},

		methods: {
			
		},
		mounted() {
			
		},
	};
</script>