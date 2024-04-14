export default {
	install(app, options) {
		app.config.globalProperties.instantUrlFile = (file) => {
			return file ? app.config.globalProperties.imgBackground(URL.createObjectURL(file)) : '';
		};

		app.config.globalProperties.setImage = (event) => {
			var input = event.target;

			if (input.files && input.files[0]) {
				var reader = new FileReader();

				window.asteroideVueEvents.emit('fileAddedToAnInput', input);

				reader.onload = (e) => {
					input.parentElement.setAttribute('style', "background: url('" + reader.result + "')no-repeat center center");
				};
				reader.readAsDataURL(input.files[0]);
			}
		};

		app.config.globalProperties.setFile = (event) => {
			var input = event.target;

			if (input.files && input.files[0]) {
				var reader = new FileReader();

				window.asteroideVueEvents.emit('fileAddedToAnInput', input);

				reader.onload = (e) => {
					input.parentElement.classList.add('active');
				};
				reader.readAsDataURL(input.files[0]);
			}
		};

		app.config.globalProperties.deleteItem = (spa = false) => {
			if (spa) {
				window.asteroideVueEvents.emit('spaDeleteItem');
				return false;
			}

			window.asteroideVueEvents.emit('deleteItemByForm');
		};

		app.config.globalProperties.liveViewItem = (spa = false) => {
			if (spa) {
				window.asteroideVueEvents.emit('spaLiveViewItem');
				return false;
			}

			window.asteroideVueEvents.emit('liveViewItem');
		};

		app.config.globalProperties.hideFilters = () => {
			window.asteroideVueEvents.emit('hideFilters');
		};

		app.config.globalProperties.hideSearch = () => {
			window.asteroideVueEvents.emit('hideSearch');
		};

		app.config.globalProperties.hideActions = () => {
			window.asteroideVueEvents.emit('hideActions');
		};

		app.config.globalProperties.showActions = () => {
			window.asteroideVueEvents.emit('showActions');
		};

		app.config.globalProperties.hideActionDelete = () => {
			window.asteroideVueEvents.emit('hideActionDelete');
		};

		app.config.globalProperties.hideActionShow = () => {
			window.asteroideVueEvents.emit('hideActionShow');
		};

		app.config.globalProperties.hidePreview = () => {
			window.asteroideVueEvents.emit('setViews', 'onlyedit');
		};

		app.config.globalProperties.hideEdit = () => {
			window.asteroideVueEvents.emit('setViews', 'onlypreview');
		};

		app.config.globalProperties.changeView = (view) => {
			window.asteroideVueEvents.emit('switchView', view);
		};

		app.config.globalProperties.showSpinner = () => {
			window.asteroideVueEvents.emit('changeSpinnerVisibility', true);
		};

		app.config.globalProperties.hideSpinner = () => {
			window.asteroideVueEvents.emit('changeSpinnerVisibility', false);
		};

		app.config.globalProperties.showViewsBar = () => {
			window.asteroideVueEvents.emit('dashboardShowViewsBar');
		};

		app.config.globalProperties.hideViewsBar = () => {
			window.asteroideVueEvents.emit('dashboardHideViewsBar', false);
		};

		app.config.globalProperties.saveWithSpinner = (formElement) => {
			app.config.globalProperties.showSpinner();

			setTimeout(() => {
				formElement.submit();
			}, 800);
		};

		app.config.globalProperties.uuid = () => {
			let array = new Uint32Array(8);
			window.crypto.getRandomValues(array);
			let str = '';
			for (let i = 0; i < array.length; i++) {
				str += (i < 2 || i > 5 ? '' : '-') + array[i].toString(16).slice(-4);
			}
			return str;
		};
	},
};
