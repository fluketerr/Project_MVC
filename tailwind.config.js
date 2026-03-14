/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./templates/**/*.php"],
  theme: {
    extend: {
       colors: {
                btnGreen: '#22c55e',
                btnGreenHover: '#16a34a',
                cardBg: '#ffffff',
                imagePlaceholder: '#dcdcdc'
                },
      fontFamily: {
        sans: ['Prompt', 'sans-serif'],
      },
    },
  },
}