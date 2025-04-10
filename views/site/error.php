<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;

$this->title = $name;

// Registrar CSS adicionales
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
$this->registerCssFile('https://unpkg.com/aos@2.3.1/dist/aos.css');

// Registrar JS adicionales
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js');
$this->registerJsFile('https://unpkg.com/aos@2.3.1/dist/aos.js');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/lottie-web@5.12.2/build/player/lottie.min.js');

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
    --danger-color: #e53e3e;
    --danger-light: #fc8181;
    --card-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    --button-shadow: 0 4px 10px rgba(26, 54, 93, 0.25);
    --transition: all 0.3s ease;
}

.site-error {
    min-height: 80vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    position: relative;
    overflow: hidden;
}

.error-container {
    background: white;
    border-radius: 20px;
    box-shadow: var(--card-shadow);
    padding: 3rem;
    max-width: 800px;
    width: 100%;
    text-align: center;
    position: relative;
    z-index: 10;
    border: 1px solid var(--light-gray);
    overflow: hidden;
}

.error-container::before {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(49, 130, 206, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    z-index: -1;
}

.error-container::after {
    content: '';
    position: absolute;
    bottom: -50px;
    left: -50px;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(229, 62, 62, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    z-index: -1;
}

.error-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    position: relative;
    display: inline-block;
}

.error-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: var(--danger-color);
    border-radius: 2px;
}

.error-code {
    font-size: 6rem;
    font-weight: 900;
    color: var(--danger-color);
    opacity: 0.2;
    position: absolute;
    top: 10px;
    right: 20px;
    line-height: 1;
    z-index: -1;
}

.error-message {
    background: rgba(229, 62, 62, 0.1);
    border-left: 4px solid var(--danger-color);
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 2rem;
    text-align: left;
    color: var(--dark-color);
    position: relative;
    overflow: hidden;
}

.error-message::before {
    content: '\f071';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
    font-size: 3rem;
    color: var(--danger-color);
    opacity: 0.1;
}

.error-description {
    color: var(--gray-color);
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.error-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
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

.btn-danger-sts {
    background: linear-gradient(135deg, var(--danger-color), var(--danger-light));
    color: white;
    padding: 0.8rem 1.8rem;
    border-radius: 8px;
    font-weight: 600;
    transition: var(--transition);
    box-shadow: 0 4px 10px rgba(229, 62, 62, 0.25);
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-danger-sts:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(229, 62, 62, 0.3);
    color: white;
    text-decoration: none;
}

.error-animation {
    width: 200px;
    height: 200px;
    margin: 0 auto 2rem;
}

#particles-js {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 0;
}

.shape {
    position: absolute;
    border-radius: 50%;
    background: rgba(49, 130, 206, 0.1);
    animation: float 8s ease-in-out infinite;
    z-index: -1;
}

.shape-1 {
    width: 100px;
    height: 100px;
    top: 10%;
    right: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 150px;
    height: 150px;
    bottom: 10%;
    left: 10%;
    background: rgba(229, 62, 62, 0.1);
    animation-delay: 2s;
}

.shape-3 {
    width: 70px;
    height: 70px;
    bottom: 20%;
    right: 20%;
    background: rgba(66, 153, 225, 0.1);
    animation-delay: 4s;
}

@keyframes float {
    0% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
    100% { transform: translateY(0) rotate(0deg); }
}

.error-details {
    background: rgba(0, 0, 0, 0.03);
    border-radius: 8px;
    padding: 1rem;
    margin-top: 2rem;
    text-align: left;
    font-family: monospace;
    max-height: 200px;
    overflow-y: auto;
    display: none;
}

.error-details.visible {
    display: block;
}

.toggle-details {
    background: none;
    border: none;
    color: var(--secondary-color);
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 1rem auto;
}

.toggle-details:hover {
    color: var(--primary-color);
}

.toggle-details i {
    transition: var(--transition);
}

.toggle-details.active i {
    transform: rotate(180deg);
}

@media (max-width: 768px) {
    .error-container {
        padding: 2rem;
    }
    
    .error-title {
        font-size: 2rem;
    }
    
    .error-code {
        font-size: 4rem;
    }
    
    .error-actions {
        flex-direction: column;
    }
    
    .error-animation {
        width: 150px;
        height: 150px;
    }
}
CSS;

$this->registerCss($customCss);

// JavaScript personalizado
$customJs = <<<JS
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
                    "value": 40,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": ["#3182ce", "#e53e3e", "#4299e1"]
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
                    "value": 0.3,
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
                    "opacity": 0.2,
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
                            "opacity": 0.5
                        }
                    },
                    "push": {
                        "particles_nb": 4
                    }
                }
            },
            "retina_detect": true
        });
    }
    
    // Lottie Animation
    if (document.getElementById('lottie-error')) {
        lottie.loadAnimation({
            container: document.getElementById('lottie-error'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'https://assets5.lottiefiles.com/packages/lf20_afwjhfb2.json' // Error animation
        });
    }
    
    // Toggle error details
    const toggleButton = document.querySelector('.toggle-details');
    const errorDetails = document.querySelector('.error-details');
    
    if (toggleButton && errorDetails) {
        toggleButton.addEventListener('click', function() {
            errorDetails.classList.toggle('visible');
            this.classList.toggle('active');
            
            if (errorDetails.classList.contains('visible')) {
                this.querySelector('span').textContent = 'Ocultar detalles técnicos';
            } else {
                this.querySelector('span').textContent = 'Mostrar detalles técnicos';
            }
        });
    }
    
    // GSAP Animations
    gsap.from('.error-title', {
        opacity: 0,
        y: -50,
        duration: 0.8,
        ease: 'power3.out'
    });
    
    gsap.from('.error-animation', {
        opacity: 0,
        scale: 0.8,
        duration: 0.8,
        delay: 0.2,
        ease: 'back.out(1.7)'
    });
    
    gsap.from('.error-message', {
        opacity: 0,
        x: -30,
        duration: 0.8,
        delay: 0.4,
        ease: 'power3.out'
    });
    
    gsap.from('.error-description', {
        opacity: 0,
        y: 30,
        duration: 0.8,
        delay: 0.6,
        ease: 'power3.out'
    });
    
    gsap.from('.error-actions', {
        opacity: 0,
        y: 30,
        duration: 0.8,
        delay: 0.8,
        ease: 'power3.out'
    });
    
    // Animate shapes
    gsap.to('.shape', {
        y: -20,
        rotation: 5,
        duration: 4,
        ease: "sine.inOut",
        repeat: -1,
        yoyo: true,
        stagger: 1
    });
    
    // Extract error code from title if possible
    const errorTitle = document.querySelector('.error-title').textContent;
    const errorCodeMatch = errorTitle.match(/(\d+)/);
    
    if (errorCodeMatch && errorCodeMatch[1]) {
        const errorCodeElement = document.querySelector('.error-code');
        if (errorCodeElement) {
            errorCodeElement.textContent = errorCodeMatch[1];
        }
    }
});
JS;

$this->registerJs($customJs);

// Extraer código de error si está presente en el título
$errorCode = '';
if (preg_match('/(\d+)/', $name, $matches)) {
    $errorCode = $matches[1];
}
?>

<div class="site-error">
    <div id="particles-js"></div>
    
    <!-- Animated background shapes -->
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    
    <div class="error-container" data-aos="fade-up">
        <?php if ($errorCode): ?>
            <div class="error-code"><?= $errorCode ?></div>
        <?php endif; ?>
        
        <div class="error-animation" id="lottie-error"></div>
        
        <h1 class="error-title"><?= Html::encode($this->title) ?></h1>
        
        <div class="error-message">
            <?= nl2br(Html::encode($message)) ?>
        </div>
        
        <div class="error-description">
            <p>Se ha producido un error mientras el servidor procesaba su solicitud. Nuestro equipo técnico ha sido notificado y estamos trabajando para solucionarlo lo antes posible.</p>
        </div>
        
        <div class="error-actions">
            <a href="<?= Yii::$app->homeUrl ?>" class="btn-primary-sts">
                <i class="fas fa-home"></i> Volver al Inicio
            </a>
            <a href="#" class="btn-danger-sts" onclick="window.history.back(); return false;">
                <i class="fas fa-arrow-left"></i> Volver Atrás
            </a>
        </div>
        
        <button class="toggle-details">
            <i class="fas fa-chevron-down"></i> <span>Mostrar detalles técnicos</span>
        </button>
        
        <div class="error-details">
            <p><strong>Información técnica:</strong></p>
            <p>URL: <?= Html::encode(Yii::$app->request->url) ?></p>
            <?php if (YII_DEBUG && isset($exception)): ?>
                <p>Archivo: <?= Html::encode($exception->getFile()) ?> (línea <?= $exception->getLine() ?>)</p>
                <p>Traza: <?= nl2br(Html::encode($exception->getTraceAsString())) ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>