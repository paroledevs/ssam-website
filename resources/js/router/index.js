import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from 'vue-auto-routing';

Vue.use(VueRouter);

routes.push({
	alias: '*',
	path: '/404',
	name: 'NotFound404',
	component: require('@/lazycomponents/NotFound404').default,
});

export default new VueRouter({
	mode: 'history',
	routes,
	scrollBehavior(to, from, savedPosition) {
		return { x: 0, y: 0 };
	},
});
