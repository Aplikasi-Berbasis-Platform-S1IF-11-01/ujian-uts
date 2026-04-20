/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  // Menambahkan strategi class agar dark mode bisa di-toggle manual
  darkMode: 'class', 
  theme: {
    extend: {
      colors: {
        // Aksen Emas untuk Dark Mode
        gold: '#D8B25C', 
        // Aksen Pink Creamy untuk Light Mode
        pinkCreamy: '#FC94AF',
        // Background Hitam pekat asli Anda
        darkBg: '#0a0a0a',
        // Background Putih Creamy untuk Light Mode
        creamyBg: '#FDFBF7',
      },
    },
  },
  plugins: [],
}