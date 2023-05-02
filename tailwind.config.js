/** @type {import('tailwindcss').Config} */
module.exports = {
  content:[
    "./app/Presenters/templates/*.latte",
    "./app/Presenters/templates/**/*.latte",
    "./app/Components/**/*.latte"
  ],
  theme: {
    extend: {
      screens: {
        'phone': '300px',
      },
      fontFamily: {
        'poppins': ["'Poppins'",'sans-serif']
      }
    },
  },
  plugins: [],
}
