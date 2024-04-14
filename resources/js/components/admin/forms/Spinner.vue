<template>

    <div id="spinner" :class="{showed : show}">
	    
	    <div class="centro">
		    
		    <div class="circle"></div>
		    <div class="circle"></div>
		    
	    </div>
	    
    </div>

</template>

<script>
export default {

	data () {
		return {
			show: false,
		}
	},

	methods: {


	},

	mounted() {

		this.listenGlobalEvent('changeSpinnerVisibility', (value) => {
			this.show = value;
		});

		this.listenGlobalEvent('changeSpinnerVisibility', (value) => {
			this.show = value;
		});
	},

};
</script>