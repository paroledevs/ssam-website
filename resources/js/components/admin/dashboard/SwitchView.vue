<template>

    <nav>
	    <button v-if="visible != 'onlyedit'" class="btn_view" :class="{active : currentView == 'preview'}"  @click="switchView('preview')"><i class="icon-eye"></i></button>
	    <button v-if="visible != 'onlypreview'" class="btn_view" :class="{active : currentView == 'edit_view'}"  @click="switchView('edit_view')"><i class="icon-pencil"></i></button>
	</nav>

</template>

<script>
export default {


    data () {
        return {
            visible: '',
            currentView:'',
        }
    },

    methods: {

        setViews(visible) {
            this.visible = visible;
        },
        
        switchView(view) {
	        
	        this.currentView = view;
	        
			if (document.getElementById('details').getElementsByClassName('view') && document.getElementById('details').getElementsByClassName('view').length > 0) {
			    for (var i = 0; i < document.getElementById('details').getElementsByClassName('view').length; ++i) {
				    document.getElementById('details').getElementsByClassName('view')[i].classList.remove('showed');
				}
			}
        	document.getElementById(view).classList.add('showed');
        	
        },

    },

    mounted() {
        this.listenGlobalEvent('setViews', this.setViews);
        this.listenGlobalEvent('switchView', this.switchView);
    },

};
</script>