/** @type {import('tailwindcss').Config} */
module.exports = {
  content:[
    "./app/Modules/**/templates/*.latte",
    "./app/Modules/**/templates/**/*.latte",
    "./app/Components/**/*.latte"
  ],
  theme: {
    extend: {
      screens: {
        'phone': '300px',
      },
      fontFamily: {
        'poppins': ["'Poppins'",'sans-serif']
      },
      colors: {
        librarius: {
          900: '#c0168a',
          100: '#d14d9c'
        }
      }
    },
  },
  plugins: [],
}
