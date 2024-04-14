export default {
	install(app, options) {
		app.config.globalProperties.alwaysTwoDigits = (number) => {
			return number < 10 ? '0' + number : number;
		};

		app.config.globalProperties.getTotalFor = (product) => {
			return (product.variant ? product.variant.price : product.price) * product.quantity;
		};

		app.config.globalProperties.getTagsAsString = (product) => {
			var string = '';

			_.each(product.tags, (tag) => {
				string += tag.title + ' / ';
			});

			string = string.trim().slice(0, -1);

			return string;
		};

		app.config.globalProperties.onlyNumbers = (event) => {
			if (_.isNaN(parseInt(event.key))) {
				event.preventDefault();
			} else {
				return true;
			}
		};
	},
};
