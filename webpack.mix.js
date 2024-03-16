const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

//  mix.js('src/app.js', 'js');
// mix.sass('src/app.scss', 'css');
// mix.js('src/app.js', 'js')
//    .sass('src/app.scss', 'css');
// mix.js('src/app.js', 'js')
//    .sass('src/app.scss', 'css')
//    .setPublicPath('dist');    
// mix.postCss('src/app.css', 'dist', [
//     require('precss')() 
// ]);
// mix.js('src/app.js', 'js')
//    .version(); => Sau khi được biên dịch, hàm băm có thể được truy xuất từ mix-manifest.json​​tệp của bạn.
// mix.js('src/app.js', 'js')
//    .vue();
// mix.js('src/app.js', 'js')
//    .vue({ version: 3 });
// mix.js('src/app.js', 'js')
//    .vue({ extractStyles: 'css/vue-styles.css' });
// mix.js('src/app.js', 'js')
//    .react();
// mix.js('src/app.js', 'js')
//    .sourceMaps();
// mix.js('src/app.js', 'js')
//    .autoload({
//        jquery: ['$', 'window.jQuery']
//     });
// mix.js('src/app.js', 'js')
//    .sass('src/app.scss', 'css')
//    .browserSync('http://your-app.test');  => Sau đó chạy npx mix watch.

//-------------------------------------
// Tải khóa tệp môi trường
// .env
// MIX_SOME_KEY=yourpublickey
// Chỉ các khóa trong .envtệp của bạn bắt đầu bằng "MIX_" mới được tải.

// webpack.mix.js
// mix.js('src/app.js', 'js')

// src/app.js
// console.log(
//     process.env.MIX_SOME_KEY
// ); 
//-------------------------------------
// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);
// mix.js('resources/js/app.js', 'public/js')
//    .autoload({
//        jquery: ['$', 'window.jQuery']
//     })

// ------------ START PROJECT 
// npx mix to combine js and css file to public
// npx mix watch to combine real time

// --- reload browser when change js
// mix.js('resources/js/app.js', 'public/js')
//    .autoload({
//        jquery: ['$', 'window.jQuery']
//     }).version().browserSync('http://localhost/carsaleproject/public/');


mix.js('resources/js/app.js', 'public/js')
.autoload({
    jquery: ['$', 'window.jQuery']
}).version();

mix.js('resources/js/appclient.js', 'public/js')
.autoload({
    jquery: ['$', 'window.jQuery']
}).version();

mix.postCss('resources/css/app.css', 'public/css', [    
]);
mix.postCss('resources/css/appclient.css', 'public/css', [    
]);
mix.postCss('resources/css/login.css', 'public/css', [
]);
