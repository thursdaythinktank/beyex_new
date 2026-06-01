/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        'apple-white': '#FFFFFF',
        'apple-gray': {
          50: '#FAFAFA',
          100: '#F5F5F7',
          200: '#E8E8ED',
          300: '#D2D2D7',
          400: '#5C5C60',
          500: '#3D3D40',
          600: '#2D2D30',
          700: '#1F1F21',
          800: '#141415',
          900: '#000000',
        },
        'apple-blue': {
          50: '#EBF3FF',
          100: '#D6E8FF',
          200: '#A8CFFF',
          400: '#64D2FF',
          500: '#0066CC',
          600: '#0051D5',
          800: '#003380',
        }
      },
      fontFamily: {
        sans: ['Inter', '-apple-system', 'BlinkMacSystemFont', 'system-ui', 'sans-serif'],
      },
      fontSize: {
        'xs': ['0.75rem', { lineHeight: '1rem' }],      // 12px
        'sm': ['0.875rem', { lineHeight: '1.25rem' }],  // 14px
        'base': ['1rem', { lineHeight: '1.5rem' }],     // 16px
        'lg': ['1.125rem', { lineHeight: '1.75rem' }],  // 18px
        'xl': ['1.25rem', { lineHeight: '1.75rem' }],   // 20px
        '2xl': ['1.5rem', { lineHeight: '2rem' }],      // 24px
        '3xl': ['1.875rem', { lineHeight: '2.25rem' }], // 30px
        '4xl': ['2.25rem', { lineHeight: '2.5rem' }],   // 36px
        '5xl': ['3rem', { lineHeight: '1' }],           // 48px
        '6xl': ['3.75rem', { lineHeight: '1' }],        // 60px
        '7xl': ['4.5rem', { lineHeight: '1' }],         // 72px
        '8xl': ['6rem', { lineHeight: '1' }],           // 96px
      },
      spacing: {
        px: '1px',
        0: '0',
        0.5: '0.125rem',  // 2px
        1: '0.25rem',     // 4px
        2: '0.5rem',      // 8px
        3: '0.75rem',     // 12px
        4: '1rem',        // 16px
        6: '1.5rem',      // 24px
        8: '2rem',        // 32px
        10: '2.5rem',     // 40px
        12: '3rem',       // 48px
        16: '4rem',       // 64px
        20: '5rem',       // 80px
        24: '6rem',       // 96px
        32: '8rem',       // 128px
        40: '10rem',      // 160px
        48: '12rem',      // 192px
      },
      boxShadow: {
        'apple-sm': '0 1px 3px rgba(0,0,0,0.08)',
        'apple': '0 4px 16px rgba(0,0,0,0.08)',
        'apple-lg': '0 8px 32px rgba(0,0,0,0.08)',
        'apple-xl': '0 16px 48px rgba(0,0,0,0.10)',
      },
      backdropBlur: {
        'apple': '20px',
      },
      borderRadius: {
        none: '0',
        sm: '0.375rem',   // 6px
        DEFAULT: '0.5rem', // 8px
        lg: '0.75rem',    // 12px
        xl: '1rem',       // 16px
        '2xl': '1.5rem',  // 24px
        full: '9999px',
      },
    },
  },
  plugins: [],
}
