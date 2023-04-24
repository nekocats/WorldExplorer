const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin')

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],


    screens: {
        sm: '480px',
        md: '768px',
        lg: '976px',
        xl: '1440px',
    },

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                estonia: ['Estonia', ...defaultTheme.fontFamily.sans],

            },

            colors: {
                materialgreenbg: '#080B00',
            },

            textShadow: {
                sm: '0 1px 2px var(--tw-shadow-color)',
                DEFAULT: '0px 4px 4px var(--tw-shadow-color)',
                lg: '0 8px 16px var(--tw-shadow-color)',
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'), plugin(function ({ matchUtilities, theme }) {
        matchUtilities(
            {
                'text-shadow': (value) => ({
                    textShadow: value,
                }),
            },
            { values: theme('textShadow') }
        )
    }),],
};
