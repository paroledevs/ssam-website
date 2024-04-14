<template>
	<div id="alerts">
		<div class="alert" :class="[alert.type, { showed: alerts[index].showed == true }]" :id="`alert${index}`" v-for="(alert, index) in alerts" :key="index" @click="closeAlert(index)">
			<span>{{ alert.message }}</span>
			<i class="fa fa-exclamation-triangle" v-if="alert.type == 'error'"></i>
			<i class="fa fa-check" v-if="alert.type == 'info'"></i>
		</div>
	</div>
</template>

<script>
    export default {
    	props: ['errors', 'notification'],
    	data() {
    		return {
    			alerts: [],
    		};
    	},

    	methods: {
    		showAlerts() {
    			setTimeout(() => {
    				this.alerts.forEach((value, i) => {
    					setTimeout(() => {
    						this.alerts[i].showed = true;
    					}, (i + 1) * 100);

    					setTimeout(() => {
    						this.alerts[i].showed = false;
    					}, (i + 1) * 100 + 6000);
    				});
    			}, 1000);
    		},

    		closeAlert(alert) {
    			this.alerts[alert].showed = false;
    		},

    		checkProps() {
    			if (!_.isEmpty(this.errors)) {
    				_.each(this.errors, (error) => {
    					this.alerts.push({
    						type: 'error',
    						message: error,
    						showed: false,
    					});
    				});
    			}

    			if (!_.isNull(this.notification) && !_.isUndefined(this.notification)) {
    				this.alerts.push({
    					type: 'info',
    					message: this.notification,
    					showed: false,
    				});
    			}
    		},

    		checkAlerts(alerts) {
    			if (!_.isEmpty(alerts)) {
    				_.each(alerts, (alert) => {
    					this.alerts.push({
    						type: alert.type,
    						message: alert.message,
    						showed: false,
    					});
    				});
    			}
    		},
    	},

    	mounted() {
    		this.checkProps();

    		this.showAlerts();

    		this.listenGlobalEvent('showAlerts', (alerts) => {
    			this.alerts = [];
    			this.checkAlerts(alerts);
    			this.showAlerts();
    		});
    	},
    };
</script>
