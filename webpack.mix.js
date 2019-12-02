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

// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');
mix.js('resources/js/app.js', 'public/js/app.js')
   .sass('resources/sass/app.scss', 'public/css/app.css')
   .styles(['resources/lib/css/style.css',
   'resources/lib/css/free.min.css',
'resources/lib/css/flag-icon.min.css'
],
   'public/css/lib.css')
   .scripts(['resources/lib/js/coreui.bundle.min.js',
// 'pace.min.js'
],'public/js/lib.js');