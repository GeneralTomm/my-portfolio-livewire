const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            white: colors.white,
            gray: colors.trueGray,
            indigo: colors.indigo,
            red: colors.rose,
            yellow: colors.amber,
            'biru-muda' : '#184e77',
            'putih': '#ffffff',
            'hitam': '#000000',
            'biru-sawan': '#cddafd',
            'biru-dop':'#3d5a80',
            'hijau-terang': '#2ec4b6',
            'hijau-muda': '#caffbf',
            'hijau': '#06d6a0',
            'orange': '#fb5607',
            'pink': '#f72585',
            'merah':'#d00000'
        },
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', 'sans-serif']
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
