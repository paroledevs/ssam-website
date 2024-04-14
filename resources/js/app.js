/**
 * Vue app for site views
 */
// import router from '@/router';
import { createApp, defineAsyncComponent } from 'vue';

const app = createApp({
	components: {
		// ExampleComponent: defineAsyncComponent(() => import('@/lazycomponents/site/ExampleComponent')),
		//App: defineAsyncComponent(() => import('@/lazycomponents/site/App')),
		planetoide: defineAsyncComponent(() => import('@/lazycomponents/site/Planetoide')),
		ShowNotifications: defineAsyncComponent(() => import('@/lazycomponents/ShowNotifications')),
		Error: defineAsyncComponent(() => import('@/lazycomponents/Error')),
		SetLocale: defineAsyncComponent(() => import('@/lazycomponents/site/SetLocale')),
		//Sharer: defineAsyncComponent(() => import('@/lazycomponents/site/Sharer')),
		Contacto: defineAsyncComponent(() => import('@/lazycomponents/site/Contacto')),
		//PhotoViewer: defineAsyncComponent(() => import('@/lazycomponents/site/PhotoViewer')),
		Gallery: defineAsyncComponent(() => import('@/lazycomponents/site/Gallery')),
		Promos: defineAsyncComponent(() => import('@/lazycomponents/site/Promos')),

	},
	// store,
	// router,
	// template: '<App/>',
	data() {
		return {
			locale: null,
			showPasswords: false,
		};
	},
	methods: {
		setLocale(locale) {
			this.locale = locale;
		},
	},
});

/**
 * Register Asteroide site plugins
 *
 */

import useInstance from '@/plugins/instance';
import useSite from '@/plugins/site';
import useShop from '@/plugins/shop';
import VueScrollTo from 'vue-scrollto';
import { ZiggyVue } from 'ziggy';
import { Ziggy } from './ziggy';
import { store } from '@/store';

app.use(ZiggyVue, Ziggy);
app.use(useInstance);
app.use(useSite);
app.use(useShop);
app.use(VueScrollTo);
app.use(store);

/**
 * Autoload site global compoments
 *
 * Eg. ./components/site/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./components/site', true, /\.vue$/i);

files.keys().map((key) => app.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Mount the App
 */
app.mount('#app');
