const mix = require('laravel-mix');



const tailwindcss = require('tailwindcss'); /* Add this line at the top */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/css/style.scss', 'public/css')
    .options({
        postCss: [ tailwindcss('./tailwind.config.js') ],
    })
    .version();


if (mix.inProduction()) {
    mix.version();
}
