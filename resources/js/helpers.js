const loadPrototypes = () => {
	FormData.prototype.appendIterator = function (data, root_wrapper) {
		for (var key in data) {
			let item = data[key];

			let wrapper = root_wrapper || '';
			let constructor = item === null || item === undefined ? null : item.constructor;

			switch (constructor) {
				case Array:
				case FileList:
					this.appendIterator(item, wrapper + (wrapper.length < 1 ? key : '[' + key + ']'));
					break;

				case File:
				case String:
				case Number:
				case Boolean:
				case null:
					this.append(`${wrapper}${wrapper.length < 1 ? key : '[' + key + ']'}`, item);
					break;

				case Object:
					this.appendIterator(item, wrapper + (wrapper.length < 1 ? key : '[' + key + ']'));

					break;
			}
		}
	};
};

const axiosInterceptors = () => {
	// Request interceptor
	window.axios.interceptors.request.use(
		(config) => {
			var appended = new FormData();
			var data = config.data;
			var method = config.method;

			if (!_.isEmpty(data)) {
				appended.appendIterator(data);
			}

			switch (config.method) {
				case 'options':
				case 'patch':
				case 'put':
				case 'delete':
					config.method = 'post';
					appended.append('_method', method.toUpperCase());
					break;
			}

			config.data = appended;

			return config;
		},
		(error) => {},
	);

	// Response interceptor
	window.axios.interceptors.response.use(
		(response) => {
			return response.hasOwnProperty('data') ? response.data : response;
		},
		(error) => {
			switch (_.get(error, 'response.status')) {
				case 422:
					let errors = error.response.data.errors;

					if (!_.isEmpty(errors)) {
						let alerts = [];
						for (var errorType in errors) {
							alerts.push({ type: 'error', message: errors[errorType][0] });
							window.asteroideVueEvents.emit('showAlerts', alerts);
						}
					}

					return false;
					break;
				case 401:
					window.asteroideVueEvents.emit('showAlerts', [{ type: 'error', message: 'Tu sesión ha expirado. Vuelve a iniciar sesión por favor.' }]);
					break;
				default:
					console.table(error);
			}
		},
	);
};

const initMap = {
	initMap: function () {
		var styles = {
			default: null,
			hide: [
				{
					featureType: 'poi.business',
					stylers: [{ visibility: 'off' }],
				},
				{
					featureType: 'transit',
					elementType: 'labels.icon',
					stylers: [{ visibility: 'off' }],
				},
			],
		};

		var ubicacion = { lat: 20.674703, lng: -103.360848 };
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 18,
			center: ubicacion,
			zoomControl: true,
			mapTypeControl: false,
			scaleControl: true,
			streetViewControl: false,
			rotateControl: false,
			fullscreenControl: false,
		});
		var marker = new google.maps.Marker({
			position: ubicacion,
			map: map,
			icon: '/images/marker.png',
		});

		map.setOptions({ styles: styles['hide'] });

		return map;
	},
};

const isBottomVisible = function (extra = 0) {
	const scrollY = window.scrollY;
	const visible = document.documentElement.clientHeight;
	const pageHeight = document.documentElement.scrollHeight;
	const bottomOfPage = visible + scrollY >= pageHeight - extra;

	return bottomOfPage;
};

const debounce = function (el, binding) {
	function debounceFn(fn, delay) {
		var timeoutID = null;
		return function () {
			clearTimeout(timeoutID);
			var args = arguments;
			var that = this;
			timeoutID = setTimeout(function () {
				fn.apply(that, args);
			}, delay);
		};
	}

	if (binding.value !== binding.oldValue) {
		el.oninput = debounceFn(function (evt) {
			el.dispatchEvent(new Event('change'));
		}, parseInt(binding.value) || 500);
	}
};

export { initMap, loadPrototypes, axiosInterceptors, isBottomVisible, debounce };
