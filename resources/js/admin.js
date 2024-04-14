/**
 * Vue app for admin views
 */

import { createApp, defineAsyncComponent } from 'vue';

const app = createApp({
	components: {
		// ExampleComponent: defineAsyncComponent(() => import('@/lazycomponents/admin/ExampleComponent')),
		ShowNotifications: defineAsyncComponent(() => import('@/lazycomponents/ShowNotifications')),
		error: defineAsyncComponent(() => import('@/lazycomponents/Error')),
	},
	data() {
		return {
			editing: false,
		};
	},
});

/**
 * Register dashboard panel components
 *
 */

const panel = require.context('./lazycomponents/admin/panel', true, /\.vue$/i);

panel.keys().map((key) => app.component(key.split('/').pop().split('.')[0], panel(key).default));

/**
 * Register Asteroide admin plugins
 *
 */

import useInstance from '@/plugins/instance';
import useDashboard from '@/plugins/dashboard';
import VCalendar from 'v-calendar';
import { ZiggyVue } from 'ziggy';
import { Ziggy } from './ziggy';

app.use(ZiggyVue, Ziggy);
app.use(useInstance);
app.use(useDashboard);
app.use(VCalendar);

/**
 * Autoload admin gloabl compoments
 *
 * Eg. ./components/admin/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./components/admin', true, /\.vue$/i);

files.keys().map((key) => app.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Mount the App
 */
window.app = app.mount('#app');
