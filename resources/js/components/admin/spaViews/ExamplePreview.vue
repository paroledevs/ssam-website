<template>
	<div :id="`${itemClass}_preview`"></div>
</template>

<script>
	export default {
		props: {
			routes: {
				default: {},
			},
		},
		data() {
			return {
				item: {},
			};
		},

		methods: {
			async getItem() {
				try {
					this.item = await window.axios.get(this.routes.show.replace('ID', item.id));
				} catch (error) {}
			},
		},
		mounted() {
			this.listenGlobalEvent('spaEditResource', this.getItem);
		},
	};
</script>
