<template></template>

<script>
	export default {
		props: {
			locale: String,
		},
		mounted() {
			this.$root.setLocale(this.locale);
		},
	};
</script>
