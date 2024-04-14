<template></template>

<script>
	export default {
		props: {
			deleteRoute: String,
			message: String,
		},
		methods: {
			deleteItem() {
				if (confirm(this.message)) {
					this.requestViaForm(this.deleteRoute, 'DELETE');
				}
			},
		},
		mounted() {
			this.listenGlobalEvent('deleteItemByForm', this.deleteItem);
		},
	};
</script>
