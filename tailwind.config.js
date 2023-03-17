/** @type {import('tailwindcss').Config} */
module.exports = {
  content:[
    "./app/Presenters/templates/*.latte",
    "./app/Presenters/templates/**/*.latte",
    "./app/Components/**/*.latte"
  ],
  theme: {
    extend: {
      fontFamily: {
        'poppins': ["'Poppins'",'sans-serif']
      },
      screens: {
        'xs': '320px',
      },
    },
  },
  plugins: [],
}
