const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        // Ganti default sans ke Poppins
         sans: ['Poppins', 'sans-serif'],
        poppins: ['Poppins', 'sans-serif'],
        jomhuria: ['Jomhuria', 'sans-serif'],
        urbanist: ['Urbanist', 'sans-serif'],
        outfit: ['Outfit', 'sans-serif'],
      },
      colors: {
        biruPrimary: '#4682B4',
        teksButtonPutih: '#F0F8FF',
        abuForgot: '#6A707C',
        abuPlaceholder: '#8391A1',
        biruCircleShapes: '#F0F8FF',
        borderAbu: '#E8ECF4',
      },
    },
  },
  plugins: [],
};
