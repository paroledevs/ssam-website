<template></template>

<script>
	export default {
		props: ['actions'],
		methods: {
			callActions() {
				for (let index = 0; index < this.actions.length; index++) {
					const action = this.actions[index];

					this[action]();
				}
			},
		},
		mounted() {
			this.callActions();
		},
	};
</script>
