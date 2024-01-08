/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'maize': {
          'light': '#F9F9F9',
          'dark': '#2E2E2E',
          'darkest': '#1E1E1E'
        }
      },
      fontFamily: {
        'maize': ['Maize', 'sans-serif'],
      },
    },
  },
  plugins: [],
}