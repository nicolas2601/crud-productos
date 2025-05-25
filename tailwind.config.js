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
                // Colores para el tema de Hardware de Videojuegos
                'gaming-primary': '#121212', // Negro profundo para fondos
                'gaming-secondary': '#1E1E1E', // Negro secundario para paneles
                'gaming-accent': '#FF0078', // Rosa neón para acentos
                'gaming-accent-alt': '#00FFFF', // Cian neón para acentos alternativos
                'gaming-text': '#FFFFFF', // Blanco para texto principal
                'gaming-text-muted': '#AAAAAA', // Gris claro para texto secundario
                'gaming-border': '#333333', // Gris oscuro para bordes
                'gaming-hover': '#FF0078', // Rosa neón para efectos hover
                'gaming-success': '#00FF41', // Verde neón para éxito
                'gaming-warning': '#FFD600', // Amarillo neón para advertencias
                'gaming-error': '#FF3D00', // Rojo neón para errores
                'gaming-card-1': '#6200EA', // Púrpura para tarjetas
                'gaming-card-2': '#1A237E', // Azul oscuro para tarjetas
                'gaming-card-3': '#311B92', // Índigo oscuro para tarjetas
                'gaming-gradient-1-start': '#FF0078', // Rosa neón para degradados
                'gaming-gradient-1-end': '#6200EA', // Púrpura para degradados
                'gaming-gradient-2-start': '#00FFFF', // Cian neón para degradados
                'gaming-gradient-2-end': '#0026FF', // Azul neón para degradados
                'gaming-gradient-3-start': '#FF3D00', // Rojo neón para degradados
                'gaming-gradient-3-end': '#FFD600', // Amarillo neón para degradados
                'gaming-overlay': 'rgba(0, 0, 0, 0.7)', // Overlay oscuro para modales
                
                // Colores originales mantenidos para compatibilidad
                'nature-green': '#34D399',
                'tech-blue': '#60A5FA',
                'earth-brown': '#A16207',
                'sky-light': '#E0F2F7',
                'forest-dark': '#1E3A8A',
                'sun-yellow': '#FCD34D',
                'mist-gray': '#D1D5DB',
                'autumn-orange': '#F97316',
                'leaf-green': '#10B981',
                'berry-red': '#DC2626',
                'water-blue': '#2563EB',
                'tech-purple': '#8B5CF6',
                'warm-brown': '#78350F',
                'golden-yellow': '#D97706',
                'forest-green': '#059669',
                'sky-blue': '#3B82F6',
                'deep-blue': '#1D4ED8',
                'stone-gray': '#6B7280',
                'ocean-blue': '#1E40AF',
                'sand-yellow': '#F59E0B',
                'volcano-red': '#EF4444',
                'lava-orange': '#F97316',
                'emerald-green': '#047857',
                'sapphire-blue': '#1E3A8A',
                'ruby-red': '#DC2626',
                'amber-yellow': '#F59E0B',
                'teal-green': '#0D9488',
                'indigo-blue': '#4F46E5',
                'crimson-red': '#B91C1C',
                'nature-primary': '#0A4F3A',
                'nature-secondary': '#38A3A5',
                'tech-accent': '#4CC9F0',
                'tech-secondary': '#7209B7',
                'earth-tone': '#A47E3B',
                'sky-gradient-start': '#89CFFD',
                'sky-gradient-end': '#A6E3E9',
                'forest-gradient-start': '#087F5B',
                'forest-gradient-end': '#34D399'
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
                glitch: {
                    '0%, 100%': { transform: 'translate(0)' },
                    '20%': { transform: 'translate(-5px, 5px)' },
                    '40%': { transform: 'translate(-5px, -5px)' },
                    '60%': { transform: 'translate(5px, 5px)' },
                    '80%': { transform: 'translate(5px, -5px)' }
                },
                neonPulse: {
                    '0%, 100%': { opacity: '1', textShadow: '0 0 5px #FF0078, 0 0 10px #FF0078, 0 0 15px #FF0078, 0 0 20px #FF0078' },
                    '50%': { opacity: '0.8', textShadow: '0 0 10px #FF0078, 0 0 20px #FF0078, 0 0 30px #FF0078, 0 0 40px #FF0078' }
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-10px)' }
                },
                rgbShift: {
                    '0%': { textShadow: '2px 0 0 #ff0000, -2px 0 0 #00ff00, 0 2px 0 #0000ff' },
                    '33%': { textShadow: '2px 0 0 #00ff00, -2px 0 0 #0000ff, 0 2px 0 #ff0000' },
                    '66%': { textShadow: '2px 0 0 #0000ff, -2px 0 0 #ff0000, 0 2px 0 #00ff00' },
                    '100%': { textShadow: '2px 0 0 #ff0000, -2px 0 0 #00ff00, 0 2px 0 #0000ff' }
                },
                flicker: {
                    '0%, 19.999%, 22%, 62.999%, 64%, 64.999%, 70%, 100%': { opacity: '1' },
                    '20%, 21.999%, 63%, 63.999%, 65%, 69.999%': { opacity: '0.4' }
                },
                zoomIn: {
                    '0%': { transform: 'scale(0.8)', opacity: '0' },
                    '100%': { transform: 'scale(1)', opacity: '1' }
                },
                slideInBottom: {
                    '0%': { transform: 'translateY(20px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' }
                },
                rotateScale: {
                    '0%': { transform: 'rotate(0) scale(0.8)', opacity: '0' },
                    '100%': { transform: 'rotate(360deg) scale(1)', opacity: '1' }
                },
                blurIn: {
                    '0%': { filter: 'blur(10px)', opacity: '0' },
                    '100%': { filter: 'blur(0)', opacity: '1' }
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
