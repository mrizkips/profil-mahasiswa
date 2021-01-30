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

mix.js('resources/js/app.js', 'public/js');

// Styles
mix.sass('resources/sass/styles.scss', 'public/css')

// JQuery
mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js');

// CoreUI Script
mix.copy('node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js', 'public/js')

// DataTables
mix.copy('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css', 'public/css');
mix.copy('node_modules/datatables.net/js/jquery.dataTables.min.js', 'public/js');
mix.copy('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js', 'public/js');
mix.copy('resources/vendor/datatable.net/dataTables.indonesian.json', 'public/js');

// Select 2
mix.copy('node_modules/select2/dist/js/i18n/id.js', 'public/js/i18n');

//fonts
mix.copy('node_modules/@coreui/icons/fonts', 'public/fonts');

//icons
mix.copy('node_modules/@coreui/icons/css/all.min.css', 'public/css');
mix.copy('node_modules/@coreui/icons/svg/flag', 'public/svg/flag');
mix.copy('node_modules/@coreui/icons/sprites/', 'public/icons/sprites');
mix.copy('resources/assets', 'public/assets');
