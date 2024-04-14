import moment from 'moment';
import _ from 'lodash';

export default {
	install(app, options) {
		app.config.globalProperties._ = _;
		app.config.globalProperties.$lodash = _;
		app.config.globalProperties.$moment = moment;
		app.config.compilerOptions.whitespace = 'preserve';

		app.config.compilerOptions.isCustomElement = (tag) => {
			return tag.startsWith('big');
		};

		app.config.globalProperties.redirect = (uri) => {
			window.location.href = uri;
		};

		app.config.globalProperties.imgBackground = (image_src) => {
			if (_.isString(image_src) && image_src.length) {
				return 'background:url("' + image_src + '")no-repeat center center;';
			}

			return '';
		};

		app.config.globalProperties.emitGlobalEvent = (name, payload) => {
			window.asteroideVueEvents.emit(name, payload || null);
		};

		app.config.globalProperties.listenGlobalEvent = (name, callback) => {
			window.asteroideVueEvents.on(name, callback);
		};

		app.config.globalProperties.showAlerts = (alerts) => {
			app.config.globalProperties.emitGlobalEvent('showAlerts', alerts);
		};

		app.config.globalProperties.noty = (message, type = 'info') => {
			app.config.globalProperties.showAlerts([{ type: type, message: message }]);
		};

		app.config.globalProperties.requestViaForm = (action, method, data, confirmMessage) => {
			let token = document.querySelector('meta[name="csrf-token"]').content;

			if (confirmMessage && !confirm(confirmMessage)) {
				return false;
			}

			if (!token) {
				throw 'CSRF token not found: missing meta[name="csrf-token"]';
			}

			var [form, inputToken, inputMethod] = [document.createElement('form'), document.createElement('input'), document.createElement('input')];

			form.method = 'POST';
			form.action = action;
			form.style = 'display:none;';

			inputToken.name = '_token';
			inputToken.value = token;

			inputMethod.name = '_method';
			inputMethod.value = method;

			form.appendChild(inputToken);
			form.appendChild(inputMethod);

			if (data) {
				for (var key in data) {
					let inputData = document.createElement('input');
					inputData.name = key;
					inputData.value = data[key] instanceof Object ? JSON.stringify(data[key]) : data[key];
					form.appendChild(inputData);
				}
			}

			document.body.appendChild(form);

			form.submit();
		};

		app.config.globalProperties.money = (price) => {
			return `$${parseFloat(price).toFixed(2)}`;
		};
	},
};
