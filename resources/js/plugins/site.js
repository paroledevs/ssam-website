export default {
	install(app, options) {
		app.config.globalProperties.getTranslation = (text, lang) => {
			text = decodeURIComponent(text);
			if (_.isNull(text) || _.isUndefined(text) || text.indexOf('##') < 0) {
				return text;
			}

			let pos = lang == 'es' ? '[0]' : '[1]';

			return _.get(_.split(text, '##'), pos, '');
		};
	},
};
