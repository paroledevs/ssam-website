import { loadPrototypes, axiosInterceptors } from '@/helpers';
import _ from 'lodash';
import mitt from 'mitt';
import moment from 'moment';

/**
 * Load Asteroide global accesible options and js configuration
 */

try {
	/*
	|--------------------------------------------------------------------------
	| FormData prototipes
	|--------------------------------------------------------------------------
	|
	| - AppenIterator
	|
	*/

	loadPrototypes();

	/*
	|--------------------------------------------------------------------------
	| Window object props
	|--------------------------------------------------------------------------
	|
	| - AppenIterator
	| - Axios
	| - Lodash
	| - Mitt global events
	|
	*/

	window._ = _;
	window.axios = require('axios');
	window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
	window.asteroideVueEvents = mitt();
	window.moment = moment;

	// CSRF Token =========================
	let token = document.querySelector('meta[name="csrf-token"]');

	if (token) {
		window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
	} else {
		console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
	}

	// API Token =========================
	let apiToken = document.querySelector('meta[name="api-token"]');

	if (apiToken) {
		window.axios.defaults.headers.Authorization = 'Bearer ' + apiToken.content;
	}

	axiosInterceptors();
} catch (e) {
	console.error('Error cargando scripts', e);
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
