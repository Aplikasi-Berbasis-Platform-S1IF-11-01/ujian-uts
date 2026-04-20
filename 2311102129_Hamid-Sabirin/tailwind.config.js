import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Outfit', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'brand-dark': '#1b0a2d',
                'brand-purple': '#a73ccb',
                'brand-pink': '#db54a4',
                'brand-accent': '#da54a4',
            },
            backgroundImage: {
                'brand-gradient': 'linear-gradient(135deg, #a73ccb 0%, #db54a4 100%)',
                'brand-gradient-hover': 'linear-gradient(135deg, #be43e6 0%, #fa62bc 100%)',
            }
        },
    },

    plugins: [forms],
};
