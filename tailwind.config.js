module.exports = {
    content: [
      'templates/**/*.html.twig',
      'assets/js/**/*.js',
    ],
    theme: {
      extend: {
        colors: {
          'green-blue': '#3292a2',
          'teal': '#14b8a6',
          'violet': '#86198f',
        },
        fontWeight: {
          medium: 500,
          semibold: 600,
        }
      },
    },
    plugins: [
      require('@tailwindcss/forms'),
    ],
  };