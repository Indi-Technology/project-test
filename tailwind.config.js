import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                cream: '#F3E2D4',
                purpleSoft: '#C5B0CD',
                blueDark: '#415E72',
                navyDark: '#17313E',
            },
        },
    },

    plugins: [forms],
};
