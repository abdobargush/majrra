const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
if (!mix.inProduction()) {
    mix.webpackConfig({
        devtool: 'source-map',
        watchOptions: {
            ignored: /node_modules/
        }
    })
    .sourceMaps()
}

mix.js('resources/js/app.js', 'public/js')
mix.sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/sass/admin.scss', 'public/css');
mix.copyDirectory('resources/assets/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/images', 'public/images');