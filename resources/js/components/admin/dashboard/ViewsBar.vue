<template>
	<div id="viewsbar" v-if="onSpaMode" v-show="show">
		<slot :on-spa-mode="onSpaMode"></slot>
	</div>
	<div id="viewsbar" v-else>
		<slot></slot>
	</div>
</template>

<script>
	export default {
		props: {
			onSpaMode: {
				default: false,
			},
		},
		data() {
			return {
				show: false,
			};
		},
		mounted() {
			this.listenGlobalEvent('dashboardShowViewsBar', () => {
				this.show = true;
			});

			this.listenGlobalEvent('dashboardHideViewsBar', () => {
				this.show = false;
			});
		},
	};
</script>
