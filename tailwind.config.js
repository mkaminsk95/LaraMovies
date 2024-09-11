import defaultTheme from 'tailwindcss/defaultTheme';
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/views/Components/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'light-background': '#d8dae1',
                'light-element': '#f4f4f4',
                'light-element-secondary': '#c1c1c1',

                'dark-background': '#111827',
                'dark-element': '#1f2937',
                'dark-element-secondary': '#334155',

                'additional-element': '#eaeaea',

                'light-text-primary': '#000000',
                'light-text-hover': '#8f8f8f',
                'light-text-secondary': '#5a5a5a',

                'dark-text-primary': '#d3d3d3',
                'dark-text-hover': '#ffffff',
                'dark-text-secondary': '#8e8e8e',

                'input-placeholder': '#8e8e8e',

                'accent-primary':'rgb(79 70 229)',
                'secondary':'rgb(51,51,51)',
                'star-gold':'rgb(202 138 4)',
                'star-gold-light':'rgb(234 179 8)',
                'primary-hovered':'rgb(99 102 241)',
                'shadow-color':'rgba(96,103,115,0.2)',
            },
            lineHeight: {
                '0': '0',
            },
            fontSize: {
                'nav-link': ['15px', '20px'],
            },
            screens: {
                sm: "640px",
                md: "768px",
                lg: "1024px",
                xl: "1280px",
                "2xl": "1536px",
            }
        },
    },

    plugins: [forms],
    darkMode: 'class'
};
