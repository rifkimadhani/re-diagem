const mix = require('laravel-mix');
mix
    /* CSS Backend*/
    .sass('resources/sass/main.scss', 'public/assets/css/codebase.css')
    .sass('resources/sass/codebase/themes/corporate.scss', 'public/assets/css/themes/')
    .sass('resources/sass/codebase/themes/earth.scss', 'public/assets/css/themes/')
    .sass('resources/sass/codebase/themes/elegance.scss', 'public/assets/css/themes/')
    .sass('resources/sass/codebase/themes/flat.scss', 'public/assets/css/themes/')
    .sass('resources/sass/codebase/themes/pulse.scss', 'public/assets/css/themes/')

    /* JS Backend*/
    .js('resources/js/codebase/app.js', 'public/assets/js/codebase.app.js')

    /* CSS Frontend */
    .js('resources/js/pages/tables_datatables.js', 'public/assets/js/pages/tables_datatables.js')

    /* Tools */
    .browserSync('localhost:8000')
    .disableNotifications()

    /* Options */
    .options({
        processCssUrls: false
});


mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
