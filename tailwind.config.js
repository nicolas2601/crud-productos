import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'nature-green': '#34D399', // Verde naturaleza vibrante
                'tech-blue': '#60A5FA', // Azul tecnológico suave
                'earth-brown': '#A16207', // Marrón tierra profundo
                'sky-light': '#E0F2F7', // Azul cielo claro
                'forest-dark': '#1E3A8A', // Azul bosque oscuro
                'sun-yellow': '#FCD34D', // Amarillo sol brillante
                'mist-gray': '#D1D5DB', // Gris niebla
                'autumn-orange': '#F97316', // Naranja otoño
                'leaf-green': '#10B981', // Verde hoja
                'berry-red': '#DC2626', // Rojo baya
                'water-blue': '#2563EB', // Azul agua intenso
                'tech-purple': '#8B5CF6', // Púrpura tecnológico
                'warm-brown': '#78350F', // Marrón cálido
                'golden-yellow': '#D97706', // Amarillo dorado
                'forest-green': '#059669', // Verde bosque
                'sky-blue': '#3B82F6', // Azul cielo
                'deep-blue': '#1D4ED8', // Azul profundo
                'stone-gray': '#6B7280', // Gris piedra
                'ocean-blue': '#1E40AF', // Azul océano
                'sand-yellow': '#F59E0B', // Amarillo arena
                'volcano-red': '#EF4444', // Rojo volcán
                'lava-orange': '#F97316', // Naranja lava
                'emerald-green': '#047857', // Verde esmeralda
                'sapphire-blue': '#1E3A8A', // Azul zafiro
                'ruby-red': '#DC2626', // Rojo rubí
                'amber-yellow': '#F59E0B', // Amarillo ámbar
                'teal-green': '#0D9488', // Verde azulado
                'indigo-blue': '#4F46E5', // Azul índigo
                'crimson-red': '#B91C1C', // Rojo carmesí

                // Colores para el tema Naturaleza-Tecnología
                'nature-primary': '#0A4F3A', // Verde oscuro profundo
                'nature-secondary': '#38A3A5', // Verde azulado
                'tech-accent': '#4CC9F0', // Azul cian brillante
                'tech-secondary': '#7209B7', // Púrpura vibrante
                'earth-tone': '#A47E3B', // Marrón tierra
                'sky-gradient-start': '#89CFFD', // Azul cielo claro para degradados
                'sky-gradient-end': '#A6E3E9', // Cian claro para degradados
                'forest-gradient-start': '#087F5B', // Verde bosque oscuro para degradados
                'forest-gradient-end': '#34D399', // Verde naturaleza vibrante para degradados
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-in-out',
                'slide-up': 'slideUp 0.5s ease-out',
                'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'bounce-light': 'bounce 1.5s infinite',
                'scale-up': 'scaleUp 0.3s ease-in-out',
                'rotate-y': 'rotateY 1s ease-in-out infinite',
                'slide-in-left': 'slideInLeft 0.5s ease-out',
                'slide-in-right': 'slideInRight 0.5s ease-out',
                'fade-in-up': 'fadeInUp 0.5s ease-out',
                'fade-in-down': 'fadeInDown 0.5s ease-out',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' }
                },
                slideUp: {
                    '0%': { transform: 'translateY(20px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' }
                },
                scaleUp: {
                    '0%': { transform: 'scale(0.95)' },
                    '100%': { transform: 'scale(1)' }
                },
                rotateY: {
                    '0%, 100%': { transform: 'rotateY(0)' },
                    '50%': { transform: 'rotateY(180deg)' }
                },
                slideInLeft: {
                    '0%': { transform: 'translateX(-20px)', opacity: '0' },
                    '100%': { transform: 'translateX(0)', opacity: '1' }
                },
                slideInRight: {
                    '0%': { transform: 'translateX(20px)', opacity: '0' },
                    '100%': { transform: 'translateX(0)', opacity: '1' }
                },
                fadeInUp: {
                    '0%': { opacity: '0', transform: 'translateY(10px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' }
                },
                fadeInDown: {
                    '0%': { opacity: '0', transform: 'translateY(-10px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' }
                },
            }
        },
    },

    plugins: [
        forms,
        typography,
    ],
};
