<template></template>

<script>
    export default {
    	props: {
    		liveRoute: String,
    	},
    	methods: {
    		openView() {
    			window.open(this.liveRoute, '_blank');
    		},
    	},
    	mounted() {
    		this.listenGlobalEvent('liveViewItem', this.openView);
    	},
    };
</script>
