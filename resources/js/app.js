import './bootstrap';
import anime from 'animejs/lib/anime.es.js';

// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', () => {
    // Activar elementos con fade-in
    const fadeElements = document.querySelectorAll('.fade-in');
    fadeElements.forEach(el => {
        el.classList.add('active');
    });

    // Animación para el navbar
    anime({
        targets: '.navbar',
        translateY: [-50, 0],
        opacity: [0, 1],
        duration: 1000,
        easing: 'easeOutExpo'
    });

    // Animación para el hero section
    anime({
        targets: '.hero-section',
        scale: [0.9, 1],
        opacity: [0, 1],
        duration: 1200,
        easing: 'easeOutExpo',
        delay: 300
    });

    // Animación para las tarjetas de características
    anime({
        targets: '.feature-card',
        translateY: [50, 0],
        opacity: [0, 1],
        duration: 1000,
        easing: 'easeOutExpo',
        delay: anime.stagger(150, {start: 500})
    });

    // Animación para las tarjetas de estadísticas
    anime({
        targets: '.stats-card',
        translateX: [-50, 0],
        opacity: [0, 1],
        duration: 800,
        easing: 'easeOutExpo',
        delay: anime.stagger(100, {start: 800})
    });

    // Animación para los botones
    anime({
        targets: '.btn',
        scale: [0.9, 1],
        opacity: [0, 1],
        duration: 600,
        easing: 'easeOutExpo',
        delay: anime.stagger(100, {start: 1000})
    });

    // Efecto de brillo para botones al hacer hover
    const buttons = document.querySelectorAll('.btn-primary');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', () => {
            anime({
                targets: button,
                boxShadow: '0 0 20px rgba(0, 228, 255, 0.8)',
                scale: 1.05,
                duration: 300,
                easing: 'easeOutExpo'
            });
        });

        button.addEventListener('mouseleave', () => {
            anime({
                targets: button,
                boxShadow: '0 0 10px rgba(0, 228, 255, 0.5)',
                scale: 1,
                duration: 300,
                easing: 'easeOutExpo'
            });
        });
    });

    // Animación para las tablas
    anime({
        targets: '.table',
        opacity: [0, 1],
        duration: 1000,
        easing: 'easeOutExpo',
        delay: 1200
    });

    // Efecto de partículas futuristas (opcional)
    const createParticle = (x, y) => {
        const particle = document.createElement('div');
        particle.style.position = 'absolute';
        particle.style.left = `${x}px`;
        particle.style.top = `${y}px`;
        particle.style.width = '2px';
        particle.style.height = '2px';
        particle.style.background = 'rgba(0, 228, 255, 0.8)';
        particle.style.borderRadius = '50%';
        particle.style.pointerEvents = 'none';
        document.body.appendChild(particle);

        anime({
            targets: particle,
            opacity: [1, 0],
            translateY: [0, -50],
            translateX: () => anime.random(-20, 20),
            scale: [1, 0],
            duration: 1000,
            easing: 'easeOutExpo',
            complete: () => {
                if (particle.parentNode) {
                    particle.parentNode.removeChild(particle);
                }
            }
        });
    };

    // Crear partículas al hacer clic en botones
    buttons.forEach(button => {
        button.addEventListener('click', (e) => {
            const rect = button.getBoundingClientRect();
            for (let i = 0; i < 10; i++) {
                createParticle(
                    rect.left + anime.random(0, rect.width),
                    rect.top + anime.random(0, rect.height)
                );
            }
        });
    });

    // Animación para los iconos de características
    anime({
        targets: '.feature-icon',
        rotate: ['-20deg', '0deg'],
        scale: [0.5, 1],
        opacity: [0, 1],
        duration: 800,
        easing: 'easeOutElastic(1, .5)',
        delay: anime.stagger(150, {start: 1000})
    });

    // Efecto de línea de escaneo futurista
    const createScanLine = () => {
        const scanLine = document.createElement('div');
        scanLine.style.position = 'fixed';
        scanLine.style.top = '0';
        scanLine.style.left = '0';
        scanLine.style.width = '100%';
        scanLine.style.height = '2px';
        scanLine.style.background = 'rgba(0, 228, 255, 0.3)';
        scanLine.style.boxShadow = '0 0 10px rgba(0, 228, 255, 0.5)';
        scanLine.style.zIndex = '9999';
        scanLine.style.pointerEvents = 'none';
        document.body.appendChild(scanLine);

        anime({
            targets: scanLine,
            translateY: [0, window.innerHeight],
            duration: 1500,
            easing: 'easeInOutSine',
            complete: () => {
                if (scanLine.parentNode) {
                    scanLine.parentNode.removeChild(scanLine);
                }
            }
        });
    };

    // Ejecutar el efecto de línea de escaneo cada 10 segundos
    createScanLine();
    setInterval(createScanLine, 10000);
});