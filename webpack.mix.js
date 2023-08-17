const mix = require('laravel-mix');

// ... otras configuraciones de mix ...

// Asignar el valor deseado para BASE_URL
const BASE_URL = 'http://localhost';

mix.js('resources/js/user.js', 'public/js')
   .webpackConfig({
       output: {
           // Configura la variable global BASE_URL con el valor asignado
           library: { name: 'BASE_URL', type: ['window', 'assign'], value: JSON.stringify(BASE_URL) },
           publicPath: '/'
       }
   })
   .vue();
