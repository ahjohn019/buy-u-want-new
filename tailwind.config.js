const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./src/**/*.{html,js}",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            width: {
                "250px": "250px",
            },
            height: {
                "3.5em": "3.5em",
                "600px": "600px",
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
