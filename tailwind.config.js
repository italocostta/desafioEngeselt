const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        primary: '#FF8DA7',      // Rosa Doce
        secondary: '#FFD6E0',    // Rosa Claro
        accent: '#FFF0F5',       // Fundo Claro
        chocolate: '#7B3F00',    // Marrom Chocolate
        creme: '#FFF5E1',        // Creme
      },
      fontFamily: {
        sans: ['Poppins', ...defaultTheme.fontFamily.sans],
      },
    },
  },
  plugins: [],
}
