const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Http/Livewire/**/*Table.php',
        './vendor/power-components/livewire-powergrid/resources/views/**/*.php',
        './vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php'
    ],

    theme: {
        extend: {
          fontFamily: {
            sans: ['Nunito', ...defaultTheme.fontFamily.sans],
          },
          backgroundColor: {
            'table': '#F3F4F6',
          }
        },
      },
      plugins: [
        require("@tailwindcss/forms")({
          strategy: 'class',
        }),
      ]
};
