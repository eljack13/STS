<?php

/** @var yii\web\View $this */

$this->title = 'STS - Sistema de Gestión Empresarial';

// Registrar CSS adicionales
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
$this->registerCssFile('https://unpkg.com/aos@2.3.1/dist/aos.css');

// Registrar JS adicionales
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js');
$this->registerJsFile('https://unpkg.com/aos@2.3.1/dist/aos.js');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/typed.js@2.0.12');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js');
$this->registerCssFile('https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css');

// CSS personalizado
$customCss = <<<CSS
:root {
    --primary-color: #1a365d;
    --primary-light: #2c5282;
    --secondary-color: #3182ce;
    --accent-color: #4299e1;
    --light-color: #f8f9fa;
    --dark-color: #1a202c;
    --gray-color: #718096;
    --light-gray: #e2e8f0;
    --success-color: #38a169;
    --warning-color: #ecc94b;
    --danger-color: #e53e3e;
    --card-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    --button-shadow: 0 4px 10px rgba(26, 54, 93, 0.25);
    --transition: all 0.3s ease;
}

.site-index {
    overflow-x: hidden;
    position: relative;
}

/* Hero section */
.hero-section {
    position: relative;
    padding: 5rem 0;
    background: linear-gradient(135deg, rgba(247, 250, 252, 0.9), rgba(237, 242, 247, 0.9));
    border-radius: 15px;
    overflow: hidden;
    margin-bottom: 4rem;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MDAiIGhlaWdodD0iNTAwIj48ZmlsdGVyIGlkPSJub2lzZSIgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSI+PGZlVHVyYnVsZW5jZSB0eXBlPSJmcmFjdGFsTm9pc2UiIGJhc2VGcmVxdWVuY3k9IjAuNjUiIG51bU9jdGF2ZXM9IjMiIHN0aXRjaFRpbGVzPSJzdGl0Y2giIHJlc3VsdD0ibm9pc2UiLz48ZmVDb2xvck1hdHJpeCB0eXBlPSJtYXRyaXgiIHZhbHVlcz0iMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMC4xIDAiLz48L2ZpbHRlcj48cmVjdCB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgZmlsdGVyPSJ1cmwoI25vaXNlKSIgb3BhY2l0eT0iMC40Ii8+PC9zdmc+');
    opacity: 0.05;
    z-index: 0;
}

#particles-js {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 0;
}

.hero-content {
    position: relative;
    z-index: 1;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.3rem;
    color: var(--gray-color);
    margin-bottom: 2rem;
    max-width: 700px;
}

.hero-buttons {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
}

.btn-primary-sts {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    color: white;
    padding: 0.8rem 1.8rem;
    border-radius: 8px;
    font-weight: 600;
    transition: var(--transition);
    box-shadow: var(--button-shadow);
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-primary-sts:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(26, 54, 93, 0.3);
    color: white;
    text-decoration: none;
}

.btn-secondary-sts {
    background: white;
    color: var(--primary-color);
    padding: 0.8rem 1.8rem;
    border-radius: 8px;
    font-weight: 600;
    transition: var(--transition);
    border: 2px solid var(--light-gray);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-secondary-sts:hover {
    border-color: var(--secondary-color);
    color: var(--secondary-color);
    transform: translateY(-3px);
    text-decoration: none;
}

.btn-lg {
    padding: 1rem 2.2rem;
    font-size: 1.1rem;
}

.hero-image {
    position: relative;
    z-index: 1;
}

.hero-image img {
    width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: var(--card-shadow);
    transition: transform 0.5s ease;
}

.hero-image:hover img {
    transform: translateY(-10px);
}

.hero-stats {
    display: flex;
    gap: 2rem;
    margin-top: 3rem;
}

.stat-item {
    display: flex;
    flex-direction: column;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 1rem;
    color: var(--gray-color);
}

.typed-cursor {
    color: var(--secondary-color);
}

/* Features section */
.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    position: relative;
    display: inline-block;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 60px;
    height: 4px;
    background: var(--secondary-color);
    border-radius: 2px;
}

.text-center .section-title::after {
    left: 50%;
    transform: translateX(-50%);
}

.section-subtitle {
    font-size: 1.2rem;
    color: var(--gray-color);
    margin-bottom: 3rem;
    max-width: 700px;
}

.text-center .section-subtitle {
    margin-left: auto;
    margin-right: auto;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.feature-card {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: var(--card-shadow);
    transition: var(--transition);
    border: 1px solid var(--light-gray);
    height: 100%;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    border-color: var(--secondary-color);
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: rgba(49, 130, 206, 0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    color: var(--secondary-color);
    font-size: 1.8rem;
    transition: var(--transition);
}

.feature-card:hover .feature-icon {
    background: var(--secondary-color);
    color: white;
}

.feature-title {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    font-weight: 700;
    color: var(--dark-color);
}

.feature-description {
    color: var(--gray-color);
    margin-bottom: 1.5rem;
}

.feature-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: var(--secondary-color);
}

.feature-link i {
    transition: var(--transition);
}

.feature-link:hover {
    text-decoration: none;
    color: var(--primary-color);
}

.feature-link:hover i {
    transform: translateX(5px);
}

/* Testimonials section */
.testimonials-section {
    background-color: white;
    padding: 4rem 0;
    border-radius: 15px;
    position: relative;
    overflow: hidden;
    margin-bottom: 4rem;
}

.testimonials-section::before {
    content: '';
    position: absolute;
    top: -100px;
    right: -100px;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(49, 130, 206, 0.05) 0%, transparent 70%);
    border-radius: 50%;
    z-index: 0;
}

.swiper {
    width: 100%;
    padding-bottom: 3rem;
}

.testimonial-card {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: var(--card-shadow);
    border: 1px solid var(--light-gray);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.testimonial-content {
    margin-bottom: 1.5rem;
    flex: 1;
    position: relative;
}

.testimonial-content::before {
    content: '"';
    position: absolute;
    top: -20px;
    left: -10px;
    font-size: 5rem;
    color: rgba(49, 130, 206, 0.1);
    font-family: Georgia, serif;
    line-height: 1;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.author-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
}

.author-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.author-info {
    display: flex;
    flex-direction: column;
}

.author-name {
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 0.2rem;
    color: var(--dark-color);
}

.author-role {
    color: var(--gray-color);
    font-size: 0.9rem;
}

.testimonial-rating {
    display: flex;
    gap: 0.2rem;
    margin-top: 0.5rem;
}

.testimonial-rating i {
    color: #ecc94b;
}

.swiper-pagination-bullet {
    width: 10px;
    height: 10px;
    background: var(--light-gray);
    opacity: 1;
}

.swiper-pagination-bullet-active {
    background: var(--secondary-color);
}

/* CTA section */
.cta-section {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    color: white;
    padding: 4rem 0;
    border-radius: 15px;
    position: relative;
    overflow: hidden;
    margin-bottom: 4rem;
}

.cta-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MDAiIGhlaWdodD0iNTAwIj48ZmlsdGVyIGlkPSJub2lzZSIgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSI+PGZlVHVyYnVsZW5jZSB0eXBlPSJmcmFjdGFsTm9pc2UiIGJhc2VGcmVxdWVuY3k9IjAuNjUiIG51bU9jdGF2ZXM9IjMiIHN0aXRjaFRpbGVzPSJzdGl0Y2giIHJlc3VsdD0ibm9pc2UiLz48ZmVDb2xvck1hdHJpeCB0eXBlPSJtYXRyaXgiIHZhbHVlcz0iMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMC4xIDAiLz48L2ZpbHRlcj48cmVjdCB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgZmlsdGVyPSJ1cmwoI25vaXNlKSIgb3BhY2l0eT0iMC40Ii8+PC9zdmc+');
    opacity: 0.1;
    z-index: 0;
}

.cta-content {
    position: relative;
    z-index: 1;
    text-align: center;
}

.cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: white;
}

.cta-description {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    opacity: 0.9;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.btn-accent {
    background: var(--accent-color);
    color: white;
    padding: 0.8rem 1.8rem;
    border-radius: 8px;
    font-weight: 600;
    transition: var(--transition);
    box-shadow: 0 4px 10px rgba(66, 153, 225, 0.25);
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-accent:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(66, 153, 225, 0.3);
    color: white;
    text-decoration: none;
}

.btn-white {
    background: white;
    color: var(--primary-color);
    padding: 0.8rem 1.8rem;
    border-radius: 8px;
    font-weight: 600;
    transition: var(--transition);
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-white:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(255, 255, 255, 0.2);
    color: var(--primary-color);
    text-decoration: none;
}

/* Animations */
.fade-in {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.fade-in.visible {
    opacity: 1;
    transform: translateY(0);
}

.scale-in {
    opacity: 0;
    transform: scale(0.9);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.scale-in.visible {
    opacity: 1;
    transform: scale(1);
}

.reveal-image {
    clip-path: inset(0 100% 0 0);
    transition: clip-path 1s cubic-bezier(0.77, 0, 0.175, 1);
}

.reveal-image.revealed {
    clip-path: inset(0 0 0 0);
}

/* Responsive styles */
@media (max-width: 992px) {
    .hero-title {
        font-size: 2.8rem;
    }
    
    .hero-buttons {
        flex-wrap: wrap;
    }
    
    .hero-stats {
        flex-wrap: wrap;
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.3rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .hero-stats {
        flex-direction: column;
        align-items: center;
    }
    
    .cta-buttons {
        flex-direction: column;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .feature-card {
        padding: 1.5rem;
    }
}
CSS;

$this->registerCss($customCss);

// JavaScript personalizado
$customJs = <<<JS
// Inicializar AOS
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar AOS
    AOS.init({
        duration: 800,
        easing: 'ease-out',
        once: true
    });
    
    // Inicializar Particles.js
    if (document.getElementById('particles-js')) {
        particlesJS('particles-js', {
            "particles": {
                "number": {
                    "value": 80,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#3182ce"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 40,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#3182ce",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 2,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "grab"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 140,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });
    }
    
    // Typed.js
    if (document.querySelector('.typed-text')) {
        new Typed('.typed-text', {
            strings: ['Gestión Empresarial', 'Control de Inventario', 'Facturación Electrónica', 'Recursos Humanos', 'Contabilidad'],
            typeSpeed: 50,
            backSpeed: 30,
            backDelay: 2000,
            loop: true
        });
    }
    
    // Swiper
    if (document.querySelector('.testimonials-swiper')) {
        new Swiper('.testimonials-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
    }
    
    // Contador de estadísticas
    const statNumbers = document.querySelectorAll('.stat-number');
    
    function animateStats() {
        statNumbers.forEach(stat => {
            const target = parseInt(stat.getAttribute('data-target'));
            const duration = 2000; // ms
            const step = target / (duration / 16); // 60fps
            let current = 0;
            
            const updateStat = () => {
                current += step;
                if (current < target) {
                    stat.textContent = Math.floor(current).toLocaleString();
                    requestAnimationFrame(updateStat);
                } else {
                    stat.textContent = target.toLocaleString();
                }
            };
            
            updateStat();
        });
    }
    
    // Iniciar animación cuando el elemento sea visible
    const statsSection = document.querySelector('.hero-stats');
    if (statsSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStats();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        observer.observe(statsSection);
    }
    
    // Animaciones de scroll
    const fadeElements = document.querySelectorAll('.fade-in');
    const scaleElements = document.querySelectorAll('.scale-in');
    const revealImages = document.querySelectorAll('.reveal-image');
    
    const elementInView = (el, dividend = 1) => {
        const elementTop = el.getBoundingClientRect().top;
        return (
            elementTop <= (window.innerHeight || document.documentElement.clientHeight) / dividend
        );
    };
    
    const handleScrollAnimations = () => {
        fadeElements.forEach((el) => {
            if (elementInView(el, 1.25)) {
                el.classList.add('visible');
            }
        });
        
        scaleElements.forEach((el) => {
            if (elementInView(el, 1.25)) {
                el.classList.add('visible');
            }
        });
        
        revealImages.forEach((el) => {
            if (elementInView(el, 1.25)) {
                el.classList.add('revealed');
            }
        });
    };
    
    window.addEventListener('scroll', () => {
        handleScrollAnimations();
    });
    
    // Iniciar animaciones al cargar la página
    handleScrollAnimations();
    
    // GSAP Animations
    gsap.registerPlugin(ScrollTrigger);
    
    // Hero animations
    gsap.from('.hero-title', {
        opacity: 0,
        y: 50,
        duration: 1,
        ease: 'power3.out'
    });
    
    gsap.from('.hero-subtitle', {
        opacity: 0,
        y: 50,
        duration: 1,
        delay: 0.3,
        ease: 'power3.out'
    });
    
    gsap.from('.hero-buttons', {
        opacity: 0,
        y: 50,
        duration: 1,
        delay: 0.6,
        ease: 'power3.out'
    });
    
    gsap.from('.hero-image', {
        opacity: 0,
        x: 100,
        duration: 1,
        delay: 0.9,
        ease: 'power3.out'
    });
    
    // Features animations
    gsap.from('.feature-card', {
        scrollTrigger: {
            trigger: '.features-grid',
            start: 'top 80%'
        },
        opacity: 0,
        y: 50,
        duration: 0.8,
        stagger: 0.2,
        ease: 'power3.out'
    });
    
    // Testimonials animations
    gsap.from('.testimonial-card', {
        scrollTrigger: {
            trigger: '.testimonials-section',
            start: 'top 80%'
        },
        opacity: 0,
        y: 50,
        duration: 0.8,
        stagger: 0.2,
        ease: 'power3.out'
    });
    
    // CTA animations
    gsap.from('.cta-content', {
        scrollTrigger: {
            trigger: '.cta-section',
            start: 'top 80%'
        },
        opacity: 0,
        y: 50,
        duration: 0.8,
        ease: 'power3.out'
    });
});
JS;

$this->registerJs($customJs);
?>

<div class="site-index">
    <!-- Hero Section -->
    <div class="hero-section">
        <div id="particles-js"></div>
        
        <div class="jumbotron text-center bg-transparent mt-3 mb-5">
            <div class="row">
                <div class="col-lg-6 hero-content" data-aos="fade-right">
                    <h1 class="hero-title">Sistema de Gestión Empresarial Integral</h1>
                    <p class="hero-subtitle">La solución completa para <span class="typed-text"></span> que tu empresa necesita para crecer y optimizar sus procesos.</p>
                    
                    <div class="hero-buttons">
                        <a href="#" class="btn-primary-sts btn-lg">
                            <i class="fas fa-rocket"></i> Comenzar Ahora
                        </a>
                        <a href="#" class="btn-secondary-sts btn-lg">
                            <i class="fas fa-play-circle"></i> Ver Demo
                        </a>
                    </div>
                    
                    <div class="hero-stats">
                        <div class="stat-item">
                            <div class="stat-number" data-target="5000">0</div>
                            <div class="stat-label">Empresas Confían en Nosotros</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number" data-target="98">0</div>
                            <div class="stat-label">% de Satisfacción</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number" data-target="24">0</div>
                            <div class="stat-label">Soporte 24/7</div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 hero-image" data-aos="fade-left">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-KHpj5Z2b0q5wXyNyAsPf4epCW4w9NA.png" alt="STS Dashboard" class="reveal-image">
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="body-content">
        <div class="text-center mb-5">
            <h2 class="section-title" data-aos="fade-up">Características Principales</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Descubre todas las herramientas que STS ofrece para optimizar la gestión de tu empresa y mejorar la productividad.</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="feature-title">Análisis en Tiempo Real</h3>
                <p class="feature-description">Obtén información valiosa sobre el rendimiento de tu empresa con dashboards personalizables y reportes detallados.</p>
                <a href="#" class="feature-link">Saber más <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <i class="fas fa-box"></i>
                </div>
                <h3 class="feature-title">Control de Inventario</h3>
                <p class="feature-description">Gestiona tu inventario de manera eficiente, con alertas de stock, seguimiento de productos y más.</p>
                <a href="#" class="feature-link">Saber más <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <h3 class="feature-title">Facturación Electrónica</h3>
                <p class="feature-description">Emite facturas electrónicas de manera rápida y sencilla, cumpliendo con todas las normativas fiscales.</p>
                <a href="#" class="feature-link">Saber más <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="feature-title">Gestión de Recursos Humanos</h3>
                <p class="feature-description">Administra a tu personal, controla asistencias, gestiona nóminas y evalúa el desempeño.</p>
                <a href="#" class="feature-link">Saber más <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <i class="fas fa-calculator"></i>
                </div>
                <h3 class="feature-title">Contabilidad Integrada</h3>
                <p class="feature-description">Mantén tus finanzas bajo control con un sistema contable completo e integrado con todas las áreas.</p>
                <a href="#" class="feature-link">Saber más <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="feature-card fade-in">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3 class="feature-title">Acceso Móvil</h3>
                <p class="feature-description">Accede a tu información desde cualquier lugar y en cualquier momento con nuestra aplicación móvil.</p>
                <a href="#" class="feature-link">Saber más <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- Testimonials Section -->
        <div class="testimonials-section">
            <div class="text-center mb-5">
                <h2 class="section-title" data-aos="fade-up">Lo Que Dicen Nuestros Clientes</h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Descubre por qué miles de empresas confían en STS para optimizar su gestión y mejorar su productividad.</p>
            </div>
            
            <div class="swiper testimonials-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <p>"STS ha transformado completamente la forma en que gestionamos nuestra empresa. Ahora tenemos toda la información centralizada y podemos tomar decisiones basadas en datos reales."</p>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-avatar">
                                    <img src="/placeholder.svg?height=60&width=60" alt="María Rodríguez">
                                </div>
                                <div class="author-info">
                                    <div class="author-name">María Rodríguez</div>
                                    <div class="author-role">CEO, Innovatech</div>
                                    <div class="testimonial-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <p>"La implementación fue rápida y sencilla. El equipo de soporte es excelente y siempre está disponible para resolver cualquier duda. Recomiendo STS a todas las empresas."</p>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-avatar">
                                    <img src="/placeholder.svg?height=60&width=60" alt="Carlos Méndez">
                                </div>
                                <div class="author-info">
                                    <div class="author-name">Carlos Méndez</div>
                                    <div class="author-role">Director de Operaciones, LogisTech</div>
                                    <div class="testimonial-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <p>"Desde que implementamos STS, hemos reducido nuestros costos operativos en un 30% y aumentado nuestra productividad. La mejor inversión que hemos hecho para nuestra empresa."</p>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-avatar">
                                    <img src="/placeholder.svg?height=60&width=60" alt="Laura Sánchez">
                                </div>
                                <div class="author-info">
                                    <div class="author-name">Laura Sánchez</div>
                                    <div class="author-role">Gerente Financiero, GrupoFinance</div>
                                    <div class="testimonial-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="cta-section">
            <div class="cta-content">
                <h2 class="cta-title" data-aos="fade-up">¿Listo para optimizar la gestión de tu empresa?</h2>
                <p class="cta-description" data-aos="fade-up" data-aos-delay="100">Únete a miles de empresas que ya confían en STS para mejorar su productividad y tomar mejores decisiones.</p>
                
                <div class="cta-buttons" data-aos="fade-up" data-aos-delay="200">
                    <a href="#" class="btn-accent btn-lg">
                        <i class="fas fa-rocket"></i> Comenzar Ahora
                    </a>
                    <a href="#" class="btn-white btn-lg">
                        <i class="fas fa-calendar-alt"></i> Solicitar Demo
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>