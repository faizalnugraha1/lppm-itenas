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
 const tailwindcss = require('tailwindcss')

 mix.js('resources/js/app.js', 'public/js')
     .sass('resources/sass/app.scss', 'public/css')
     .options({
         processCssUrls: false,
         postCss: [ tailwindcss('./tailwind.config.js') ],
     })
     .autoload({
         'jquery': ['$', 'window.jQuery', 'jQuery']
     });
// mix
//   .js('resources/js/app.js', 'public/js')
//   .postCss('resources/css/app.css', 'public/css', [
//     require('postcss-import'),
//     require('tailwindcss'),
//     require('postcss-nested'),
//     require('autoprefixer'),
//   ]);

// if (mix.inProduction()) {
//   mix
//     .version();
// }
