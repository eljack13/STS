<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
// Register required CSS libraries
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerCssFile('https://unpkg.com/aos@2.3.1/dist/aos.css');

// Register required JS libraries
$this->registerJsFile('https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js');
$this->registerJsFile('https://unpkg.com/aos@2.3.1/dist/aos.js');
$this->registerJsFile('https://unpkg.com/@barba/core');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/plugins/animation.gsap.min.js');

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

// Custom CSS for professional navbar with serious colors
$customCss = <<<CSS
    :root {
        /* Professional color palette */
        --primary-color: #1a365d; /* Dark navy blue */
        --secondary-color: #2c5282; /* Medium blue */
        --accent-color: #3182ce; /* Bright blue */
        --text-color: #2d3748; /* Dark gray */
        --light-color: #f8f9fa; /* Light gray */
        --dark-color: #1a202c; /* Very dark gray */
        --border-color: #e2e8f0; /* Light border */
        --hover-color: #edf2f7; /* Light hover */
        --transition-speed: 0.3s;
    }
    
    body {
        overflow-x: hidden;
        color: var(--text-color);
    }
    
    /* Professional navbar */
    .elegant-navbar {
        background: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 0.6rem 1rem;
        transition: all 0.4s ease;
        border-bottom: 1px solid var(--border-color);
    }
    
    .elegant-navbar.scrolled {
        padding: 0.4rem 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    /* Brand styling */
    .navbar-brand {
        font-weight: 700;
        font-size: 1.8rem;
        letter-spacing: -0.5px;
        position: relative;
        padding: 0.5rem 0;
    }
    
    .brand-text {
        color: var(--primary-color);
        display: inline-block;
        position: relative;
        padding-right: 10px;
    }
    
    .brand-text::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--primary-color);
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.4s ease;
    }
    
    .navbar-brand:hover .brand-text::after {
        transform: scaleX(1);
        transform-origin: left;
    }
    
    /* Main navigation styling */
    .main-nav .nav-item {
        margin: 0 5px;
        position: relative;
    }
    
    .main-nav .nav-link {
        color: var(--text-color);
        font-weight: 500;
        padding: 0.7rem 1rem;
        border-radius: 4px;
        transition: all var(--transition-speed);
        display: flex;
        align-items: center;
    }
    
    .main-nav .nav-link:hover {
        color: var(--primary-color);
        background-color: var(--hover-color);
    }
    
    /* Icon styling */
    .nav-icon {
        margin-right: 8px;
        font-size: 1.1rem;
        transition: transform 0.3s ease;
        color: var(--secondary-color);
    }
    
    .nav-link:hover .nav-icon {
        transform: translateY(-2px);
    }
    
    /* Login button */
    .login-link {
        background-color: var(--primary-color);
        color: white !important;
        border-radius: 4px;
        padding: 0.5rem 1.5rem !important;
        box-shadow: 0 2px 5px rgba(26, 54, 93, 0.2);
        transition: all 0.3s ease;
        border: 1px solid var(--primary-color);
    }
    
    .login-link:hover {
        background-color: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(26, 54, 93, 0.3);
    }
    
    /* User dropdown styling */
    .user-dropdown-toggle {
        display: flex;
        align-items: center;
        background-color: rgba(26, 54, 93, 0.05);
        border-radius: 4px;
        padding: 0.5rem 1.2rem !important;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }
    
    .user-dropdown-toggle:hover {
        background-color: rgba(26, 54, 93, 0.1);
        border-color: var(--border-color);
    }
    
    .user-dropdown-toggle .nav-icon {
        font-size: 1.3rem;
        color: var(--primary-color);
    }
    
    .user-email {
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        margin-left: 8px;
    }
    
    /* Dropdown menu styling */
    .user-dropdown-menu {
        border: 1px solid var(--border-color);
        border-radius: 4px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        padding: 0.5rem;
        min-width: 220px;
        margin-top: 0.5rem !important;
    }
    
    .user-dropdown-menu .dropdown-item {
        border-radius: 4px;
        padding: 0.6rem 1rem;
        transition: all 0.2s ease;
    }
    
    .user-dropdown-menu .dropdown-item i {
        margin-right: 10px;
        color: var(--secondary-color);
    }
    
    .user-dropdown-menu .dropdown-item:hover {
        background-color: var(--hover-color);
    }
    
    .dropdown-divider {
        border-color: var(--border-color);
        margin: 0.5rem 0;
    }
    
    /* Logout button styling */
    .logout-button {
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        padding: 0.6rem 1rem;
        display: flex;
        align-items: center;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .logout-button:hover {
        background-color: rgba(220, 53, 69, 0.1) !important;
    }
    
    .logout-button i {
        color: #dc3545 !important;
        margin-right: 10px;
    }
    
    /* Navbar toggler for mobile */
    .custom-toggler {
        border: 1px solid var(--border-color);
        padding: 0.4rem;
        border-radius: 4px;
        background-color: white;
    }
    
    .custom-toggler:focus {
        box-shadow: none;
        outline: none;
    }
    
    .custom-toggler .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2826, 54, 93, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
    
    /* Footer styling */
    #footer {
        background-color: #f8f9fa !important;
        border-top: 1px solid var(--border-color);
    }
    
    /* Main content area */
    #main {
        padding-top: 80px;
        min-height: calc(100vh - 60px);
    }
    
    /* Animation classes */
    .fade-in {
        animation: fadeIn 0.5s ease forwards;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    /* Enhanced mobile responsiveness */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            background: white;
            border-radius: 4px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            margin-top: 1rem;
            border: 1px solid var(--border-color);
        }
        
        .main-nav .nav-item {
            margin: 0.3rem 0;
        }
        
        .main-nav .nav-link {
            padding: 0.8rem 1rem;
        }
        
        .user-nav {
            margin-top: 0.5rem;
            padding-top: 0.5rem;
            border-top: 1px solid var(--border-color);
        }
        
        .user-dropdown-toggle {
            width: 100%;
            justify-content: center;
        }
        
        .user-email {
            max-width: none;
        }
        
        .login-link {
            width: 100%;
            text-align: center;
            justify-content: center;
            display: flex;
            align-items: center;
        }
    }
    
    @media (max-width: 767.98px) {
        .navbar-brand {
            font-size: 1.5rem;
        }
        
        #main {
            padding-top: 70px;
        }
        
        .user-dropdown-menu {
            position: static !important;
            transform: none !important;
            width: 100%;
            margin-top: 0.5rem;
            box-shadow: none;
            border: 1px solid var(--border-color);
        }
    }
    
    @media (max-width: 575.98px) {
        .navbar-brand {
            font-size: 1.4rem;
        }
        
        .nav-icon {
            font-size: 1rem;
        }
        
        .nav-text {
            font-size: 0.9rem;
        }
    }
    
    /* Active state for nav items */
    .nav-item.active .nav-link {
        background-color: rgba(26, 54, 93, 0.1);
        color: var(--primary-color);
        font-weight: 600;
    }
    
    /* Scroll indicator */
    .scroll-indicator {
        position: fixed;
        top: 0;
        left: 0;
        height: 3px;
        background: var(--primary-color);
        z-index: 9999;
        width: 0%;
    }
CSS;

$this->registerCss($customCss);

// Custom JavaScript for animations and interactions
$customJs = <<<JS
    // Initialize AOS with conservative settings
    AOS.init({
        duration: 600,
        easing: 'ease-out',
        once: true,
        offset: 100
    });
    
    // GSAP animations and effects
    document.addEventListener('DOMContentLoaded', function() {
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('main-navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Create a timeline for navbar elements animation
        const navTimeline = gsap.timeline();
        
        // Animate brand
        navTimeline.from('.navbar-brand', {
            opacity: 0,
            x: -20,
            duration: 0.6,
            ease: "power2.out"
        });
        
        // Animate navbar items with staggered effect
        navTimeline.from('.main-nav .nav-item', {
            opacity: 0,
            y: -10,
            stagger: 0.1,
            duration: 0.5,
            ease: "power2.out"
        }, "-=0.3");
        
        // Animate user nav
        navTimeline.from('.user-nav', {
            opacity: 0,
            x: 10,
            duration: 0.5,
            ease: "power2.out"
        }, "-=0.3");
        
        // Add scroll indicator
        const body = document.body;
        const scrollIndicator = document.createElement('div');
        scrollIndicator.classList.add('scroll-indicator');
        body.appendChild(scrollIndicator);
        
        window.addEventListener('scroll', function() {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            
            scrollIndicator.style.width = scrolled + '%';
        });
        
        // Fix for dropdown functionality
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const dropdownMenu = this.nextElementSibling;
                const isOpen = dropdownMenu.classList.contains('show');
                
                // Close all other dropdowns
                document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                    if (menu !== dropdownMenu) {
                        menu.classList.remove('show');
                        menu.previousElementSibling.setAttribute('aria-expanded', 'false');
                    }
                });
                
                // Toggle current dropdown
                if (isOpen) {
                    dropdownMenu.classList.remove('show');
                    this.setAttribute('aria-expanded', 'false');
                } else {
                    dropdownMenu.classList.add('show');
                    this.setAttribute('aria-expanded', 'true');
                }
            });
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                    menu.classList.remove('show');
                    menu.previousElementSibling.setAttribute('aria-expanded', 'false');
                });
            }
        });
        
        // Ensure logout button works
        document.querySelectorAll('.logout-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                // Allow the form to submit normally
                // This is important for CSRF token validation
            });
        });
        
        // Fix for mobile menu toggle
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.querySelector('.navbar-collapse');
        
        if (navbarToggler && navbarCollapse) {
            navbarToggler.addEventListener('click', function() {
                navbarCollapse.classList.toggle('show');
                const isExpanded = navbarCollapse.classList.contains('show');
                this.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
            });
        }
        
        // Add active class to current page nav item
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-link').forEach(link => {
            const href = link.getAttribute('href');
            if (href && currentPath.includes(href)) {
                link.closest('.nav-item').classList.add('active');
            }
        });
    });
JS;

$this->registerJs($customJs);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header" class="elegant-header" data-aos="fade-down" data-aos-duration="600">
    <?php
    NavBar::begin([
        'brandLabel' => '<span class="brand-text">STS</span>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-expand-md fixed-top elegant-navbar',
            'id' => 'main-navbar'
        ],
        'innerContainerOptions' => [
            'class' => 'container-fluid px-4'
        ],
        'togglerContent' => '<span class="navbar-toggler-icon"></span>',
        'togglerOptions' => [
            'class' => 'navbar-toggler custom-toggler'
        ],
    ]);
    
    // Only show navigation items if user is logged in
    if (!Yii::$app->user->isGuest) {
        echo Nav::widget([ 
            'options' => ['class' => 'navbar-nav me-auto main-nav'],
            'encodeLabels' => false,
            'items' => [
                ['label' => '<i class="fas fa-home nav-icon"></i><span class="nav-text">Inicio</span>', 'url' => ['/site/index']],
                ['label' => '<i class="fas fa-chart-line nav-icon"></i><span class="nav-text">Materiales</span>', 'url' => ['/materiales/index']],
                ['label' => '<i class="fas fa-users nav-icon"></i><span class="nav-text">Usuarios</span>', 'url' => ['/usuarios/index']],
                ['label' => '<i class="fas fa-tasks nav-icon"></i><span class="nav-text">Tareas</span>', 'url' => ['/tareas/index']],
                ['label' => '<i class="fas fa-file-alt nav-icon"></i><span class="nav-text">Reportes</span>', 'url' => ['/reportes/index']],
            ]
        ]);
    } else {
        // For guests, only show a minimal nav with home
        echo Nav::widget([ 
            'options' => ['class' => 'navbar-nav me-auto main-nav'],
            'encodeLabels' => false,
            'items' => [
                ['label' => '<i class="fas fa-home nav-icon"></i><span class="nav-text">Inicio</span>', 'url' => ['/site/index']],
                ['label' => '<i class="fas fa-info-circle nav-icon"></i><span class="nav-text">Sobre nosotros</span>', 'url' => ['/site/about']],
                ['label' => '<i class="fas fa-question-circle nav-icon"></i><span class="nav-text">Contacto</span>', 'url' => ['/site/contact'], 'linkOptions' => ['class' => 'nav-link help-link']                ],

            ]
        ]);
    }

    if (Yii::$app->user->isGuest) {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ms-auto user-nav'],
            'encodeLabels' => false,
            'items' => [
                ['label' => '<i class="fas fa-sign-in-alt nav-icon"></i><span class="nav-text">Login</span>', 
                 'url' => ['/site/login'], 
                 'linkOptions' => ['class' => 'nav-link login-link']]
            ]
        ]);
    } else {
        // Standard Bootstrap dropdown implementation
        echo '<ul class="navbar-nav ms-auto user-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle user-dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle nav-icon"></i>
                        <span class="nav-text user-email">' . Yii::$app->user->identity->tbl_usuarios_email . '</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end user-dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog"></i> Perfil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-bell"></i> Notificaciones</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Configuración</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>' . 
                            Html::beginForm(['/site/logout'], 'post', ['class' => 'logout-form']) .
                            Html::submitButton('<i class="fas fa-sign-out-alt"></i> Cerrar sesión', ['class' => 'dropdown-item logout-button']) .
                            Html::endForm() . 
                        '</li>
                    </ul>
                </li>
            </ul>';
    }
    
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3" data-aos="fade-up">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>