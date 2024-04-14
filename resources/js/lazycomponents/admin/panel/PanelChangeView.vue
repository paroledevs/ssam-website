<template></template>

<script>
	export default {
		props: {
			view: {
				type: String,
				default: 'edit_view',
			},
		},
		mounted() {
			this.changeView(this.view);
		},
	};
</script>
