const mix = require('laravel-mix');
const homedir = require('os').homedir();
const path = require('path');

/*
|--------------------------------------------------------------------------
| Config
|--------------------------------------------------------------------------
|
*/

const autoLoadRoutes = false;

// Autodetected
require('dotenv').config();
const domain = process.env.APP_URL.split('//')['1'];
const useHttps = process.env.APP_URL.split('//')['0'] == 'https:' ? true : false;
const plugins = [];
require('laravel-mix-serve');

const vueCompilerOptions = {
	options: {
		compilerOptions: {
			isCustomElement: (tag) => ['big'].includes(tag),
			whitespace: 'preserve',
		},
	},
};

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 */

if (autoLoadRoutes) {
	const VueAutoRoutingPlugin = require('vue-auto-routing/lib/webpack-plugin');

	plugins.push(
		new VueAutoRoutingPlugin({
			pages: 'resources/js/pages',
			importPrefix: '@/pages/',
		}),
	);
}

mix.alias({
	ziggy: path.resolve('vendor/tightenco/ziggy/dist/vue'),
});

mix.serve('php artisan ziggy:generate');

mix.webpackConfig({
	resolve: {
		extensions: ['.js', '.vue', '.json'],
		alias: {
			'@': __dirname + '/resources/js',
		},
	},
	plugins: plugins,
}).autoload({
	_: ['lodash'],
});

if (mix.inProduction()) {
	mix.js(['resources/js/bootstrap.js', 'resources/js/app.js'], 'public/js/app.js').js(['resources/js/bootstrap.js', 'resources/js/admin.js'], 'public/js/admin.js').vue(vueCompilerOptions).extract(['vue']).version();
} else {
	mix.js(['resources/js/bootstrap.js', 'resources/js/app.js'], 'public/js/app.js')
		.js(['resources/js/bootstrap.js', 'resources/js/admin.js'], 'public/js/admin.js')
		.browserSync({
			proxy: (useHttps ? 'https://' : 'http://') + domain,
			host: domain,
			open: 'external',
			...(useHttps && {
				https: {
					key: homedir + '/.config/valet/Certificates/' + domain + '.key',
					cert: homedir + '/.config/valet/Certificates/' + domain + '.crt',
				},
			}),
		})
		.vue(vueCompilerOptions)
		.extract(['vue']);
	mix.webpackConfig({
		devtool: 'inline-source-map',
	});
}
