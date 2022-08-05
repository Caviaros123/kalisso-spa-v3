const mix = require("laravel-mix");

mix.browserSync({
    proxy: "http://127.0.0.1:8000",
});

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
mix.webpackConfig({ stats: { children: true } });

mix.js("resources/js/app.js", "public/js")
    .vue()
    .postCss('resources/css/app.css', 'public/css');



// mix.js('resources/js/app.js', 'public/js')
//     .vue()
//     .js([
//         // 'public/js/app.js',
//         'public/js/script.js',
//         'public/js/xzoom.min.js',
//     ], 'public/js/app.js')
//     .styles([
//         'public/css/bootstrap.css',
//         'public/fonts/fontawesome/css/all.min.css',
//         'public/css/ui.css',
//         'public/css/responsive.css',
//         'public/css/xzoom.css'
//     ], 'public/css/app.css');