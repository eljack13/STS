<?php
/* @var $this yii\web\View */

$this->context->layout = 'main'; // Asegura que se use el layout principal

use app\models\TblMateriales;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$this->title = 'Inventario de Materiales';

// Registrar assets
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js', ['position' => \yii\web\View::POS_END]);
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

// CSS personalizado
$this->registerCss("
    :root {
        --primary-gradient: #2c5282;
        --primary-color: #1a2a6c;
        --secondary-color: #b21f1f;
        --accent-color: #fdbb2d;
        --text-dark: #2d3436;
        --text-medium: #636e72;
        --text-light: #b2bec3;
        --bg-light: #f7f9fc;
        --bg-white: #ffffff;
        --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        --card-shadow-hover: 0 15px 30px rgba(0, 0, 0, 0.1);
        --success-color: #00b894;
        --warning-color: #fdcb6e;
        --danger-color: #d63031;
        --info-color: #0984e3;
    }
    
    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--bg-light);
        color: var(--text-dark);
    }
    
    .materials-container {
        padding: 2rem 0;
        opacity: 0;
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .materials-header {
        background: var(--primary-gradient);
        border-radius: 16px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(26, 42, 108, 0.15);
        transform: translateY(20px);
        opacity: 0;
    }
    
    .materials-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: rgba(255, 255, 255, 0.1);
        transform: rotate(30deg);
    }
    
    .materials-title {
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .materials-subtitle {
        color: rgba(255, 255, 255, 0.9);
        margin-top: 0.5rem;
        font-size: 1.1rem;
        position: relative;
        z-index: 1;
        font-weight: 300;
    }
    
    .materials-actions {
        margin: 1.5rem 0;
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        transform: translateY(20px);
        opacity: 0;
    }
    
    .search-container {
        position: relative;
        flex-grow: 1;
        max-width: 500px;
    }
    
    .search-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 3rem;
        border-radius: 50px;
        border: 1px solid rgba(0,0,0,0.05);
        background-color: var(--bg-white);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.03);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        font-family: 'Poppins', sans-serif;
    }
    
    .search-input:focus {
        box-shadow: 0 4px 15px rgba(26, 42, 108, 0.1);
        border-color: var(--primary-color);
        outline: none;
    }
    
    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-medium);
        transition: all 0.3s ease;
    }
    
    .search-input:focus + .search-icon {
        color: var(--primary-color);
    }
    
    .btn-material {
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        font-family: 'Poppins', sans-serif;
        border: none;
        cursor: pointer;
    }
    
    .btn-material-primary {
        background: var(--primary-gradient);
        color: white;
    }
    
    .btn-material-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 14px rgba(26, 42, 108, 0.2);
    }
    
    .btn-material-secondary {
        background: var(--bg-white);
        color: var(--primary-color);
        border: 1px solid rgba(26, 42, 108, 0.2);
    }
    
    .btn-material-secondary:hover {
        background: rgba(26, 42, 108, 0.05);
        color: var(--primary-color);
        transform: translateY(-3px);
        box-shadow: 0 7px 14px rgba(0, 0, 0, 0.07);
    }
    
    .grid-container {
        background-color: var(--bg-white);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transform: translateY(20px);
        opacity: 0;
    }
    
    .grid-view {
        padding: 0;
        border: none;
        transition: opacity 0.5s ease;
    }

    .grid-view.visible {
        opacity: 1 !important;
        display: block !important;
    }

    .grid-view .table tr.visible {
        opacity: 1 !important;
        height: auto !important;
        display: table-row !important;
    }
    
    .grid-view .table {
        margin-bottom: 0;
        width: 100%;
    }
    
    .grid-view .table th {
        background-color: rgba(247, 249, 252, 0.8);
        color: var(--text-dark);
        font-weight: 600;
        border-top: none;
        padding: 1rem;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    
    .grid-view .table td {
        padding: 1rem;
        vertical-align: middle;
        border-top: 1px solid rgba(0,0,0,0.03);
        transition: all 0.3s ease;
    }
    
    .grid-view .table tr {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    .grid-view .table tr:hover {
        background-color: rgba(26, 42, 108, 0.02);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .material-badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .material-badge-quantity {
        background-color: rgba(9, 132, 227, 0.1);
        color: var(--info-color);
    }
    
    .material-badge-date {
        background-color: rgba(0, 184, 148, 0.1);
        color: var(--success-color);
    }
    
    .action-column {
        width: 120px;
    }
    
    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 3px;
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        color: white;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }
    
    .action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: scale(0);
        transition: all 0.3s ease;
    }
    
    .action-btn:hover::before {
        transform: scale(1.5);
    }
    
    .action-btn:hover {
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .action-btn-view {
        background-color: var(--info-color);
    }
    
    .action-btn-edit {
        background-color: var(--warning-color);
    }
    
    .action-btn-delete {
        background-color: var(--danger-color);
    }
    
    .pagination {
        margin-top: 1.5rem;
        justify-content: center;
    }
    
    .pagination .page-item .page-link {
        border-radius: 50%;
        margin: 0 5px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-dark);
        border: none;
        background-color: var(--bg-white);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    .pagination .page-item.active .page-link {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 4px 10px rgba(26, 42, 108, 0.2);
    }
    
    .pagination .page-item .page-link:hover {
        background-color: rgba(26, 42, 108, 0.05);
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.08);
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem;
    }
    
    .empty-state-icon {
        font-size: 4rem;
        color: var(--text-light);
        margin-bottom: 1rem;
    }
    
    .empty-state-text {
        color: var(--text-medium);
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
    }
    
    /* Card view styles */
    .card-view {
        display: none;
        opacity: 0;
    }
    
    .card-view.active {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        opacity: 1;
    }
    
    .materials-card {
        background-color: var(--bg-white);
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        padding: 1.5rem;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        transform: translateY(20px);
        opacity: 0;
        border: 1px solid rgba(0,0,0,0.03);
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .materials-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--primary-gradient);
        transform: scaleY(0);
        transform-origin: bottom;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .materials-card:hover::before {
        transform: scaleY(1);
    }
    
    .materials-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-shadow-hover);
    }
    
    .materials-card-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--text-dark);
        position: relative;
        padding-bottom: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .materials-card-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background: var(--primary-gradient);
        border-radius: 3px;
        transition: width 0.3s ease;
    }
    
    .materials-card:hover .materials-card-title::after {
        width: 70px;
    }
    
    .materials-card-info {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 1rem;
        flex: 1;
    }
    
    .materials-card-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .materials-card-label {
        color: var(--text-medium);
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .materials-card-value {
        font-weight: 500;
        color: var(--text-dark);
    }
    
    .materials-card-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid rgba(0,0,0,0.03);
    }
    
    /* Responsive styles */
    @media (max-width: 1200px) {
        .card-view.active {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 992px) {
        .materials-title {
            font-size: 2rem;
        }
        
        .materials-actions {
            flex-direction: column;
            align-items: stretch;
        }
        
        .search-container {
            max-width: 100%;
            margin-bottom: 1rem;
        }
    }
    
    @media (max-width: 768px) {
        .grid-view {
            display: none;
        }
        
        .card-view.active {
            grid-template-columns: 1fr;
        }
        
        .materials-header {
            padding: 1.5rem;
        }
        
        .materials-title {
            font-size: 1.8rem;
        }
    }
    
    /* Animation classes */
    .animated-element {
        will-change: transform, opacity;
    }
    
    /* Loading animation */
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }
    
    .loading-pulse {
        animation: pulse 1.5s ease-in-out infinite;
    }
    
    /* Floating animation */
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-5px);
        }
    }
    
    .float-animation {
        animation: float 3s ease-in-out infinite;
    }
    
    /* Shimmer effect */
    .shimmer {
        position: relative;
        overflow: hidden;
    }
    
    .shimmer::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        transform: translateX(-100%);
        background-image: linear-gradient(
            90deg,
            rgba(255, 255, 255, 0) 0,
            rgba(255, 255, 255, 0.2) 20%,
            rgba(255, 255, 255, 0.5) 60%,
            rgba(255, 255, 255, 0)
        );
        animation: shimmer 2s infinite;
    }
    
    @keyframes shimmer {
        100% {
            transform: translateX(100%);
        }
    }
    
    /* View toggle button styles */
    .toggle-view-container {
        position: relative;
        display: inline-flex;
        background: var(--bg-white);
        border-radius: 50px;
        padding: 0.3rem;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(26, 42, 108, 0.1);
    }
    
    .toggle-view-btn {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 1;
        background: transparent;
        border: none;
        color: var(--text-medium);
    }
    
    .toggle-view-btn.active {
        color: white;
    }
    
    .toggle-view-slider {
        position: absolute;
        top: 0.3rem;
        left: 0.3rem;
        height: calc(100% - 0.6rem);
        border-radius: 50px;
        background: var(--primary-gradient);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        z-index: 0;
    }
");

// JavaScript personalizado
$customJS = <<<JS
    // Inicializar GSAP y ScrollTrigger
    gsap.registerPlugin(ScrollTrigger);
    
    // Función para animar la página
    function animatePage() {
        // Timeline principal
        const mainTl = gsap.timeline();
        
        // Mostrar el contenedor principal con un fade in
        mainTl.to(".materials-container", {
            opacity: 1,
            duration: 0.8,
            ease: "power2.out"
        });
        
        // Animación del encabezado con un efecto de rebote suave
        mainTl.to(".materials-header", {
            y: 0,
            opacity: 1,
            duration: 1,
            ease: "back.out(1.4)",
        }, "-=0.4");
        
        // Animar el título con un efecto de texto que se escribe
        const titleText = document.querySelector('.materials-title').textContent;
        document.querySelector('.materials-title').innerHTML = '';
        document.querySelector('.materials-title').style.opacity = 1;
        
        let titleHTML = '';
        for (let i = 0; i < titleText.length; i++) {
            titleHTML += '<span style="opacity: 0; display: inline-block;">' + titleText[i] + '</span>';
        }
        document.querySelector('.materials-title').innerHTML = titleHTML;
        
        mainTl.to(".materials-title span", {
            opacity: 1,
            stagger: 0.03,
            duration: 0.1,
            ease: "power1.out",
        }, "-=0.6");
        
        // Animar el subtítulo con un fade in
        mainTl.to(".materials-subtitle", {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: "power2.out",
        }, "-=0.4");
        
        // Animar las acciones
        mainTl.to(".materials-actions", {
            y: 0,
            opacity: 1,
            duration: 0.8,
            ease: "power2.out",
        }, "-=0.6");
        
        // Animar la vista activa (tabla o tarjetas)
        if ($(window).width() > 768) {
            // Animación para vista de tabla
            mainTl.to(".grid-container", {
                y: 0,
                opacity: 1,
                duration: 0.8,
                ease: "power2.out",
                onComplete: animateTableRows
            }, "-=0.4");
        } else {
            // Animación para vista de tarjetas
            mainTl.to(".card-view", {
                opacity: 1,
                duration: 0.8,
                ease: "power2.out",
                onComplete: function() {
                    gsap.to(".materials-card", {
                        y: 0,
                        opacity: 1,
                        duration: 0.6,
                        stagger: 0.1,
                        ease: "back.out(1.2)"
                    });
                }
            }, "-=0.4");
        }
        
        // Animar elementos cuando son visibles al hacer scroll
        gsap.utils.toArray(".materials-card").forEach((card, i) => {
            ScrollTrigger.create({
                trigger: card,
                start: "top 90%",
                onEnter: () => {
                    gsap.to(card, {
                        y: 0,
                        opacity: 1,
                        duration: 0.8,
                        ease: "back.out(1.2)",
                        delay: i * 0.1
                    });
                },
                once: true
            });
        });
    }
    
    // Animación para filas de la tabla
    function animateTableRows() {
        gsap.from(".grid-view tbody tr", {
            y: 20,
            opacity: 0,
            duration: 0.4,
            stagger: 0.05,
            ease: "power1.out"
        });
    }
    
    // Efecto hover para filas de la tabla usando GSAP
    function setupTableHover() {
        $(".grid-view tbody tr").hover(
            function() {
                gsap.to(this, {
                    backgroundColor: "rgba(26, 42, 108, 0.02)",
                    y: -2,
                    boxShadow: "0 5px 15px rgba(0, 0, 0, 0.05)",
                    duration: 0.3,
                    ease: "power2.out"
                });
            },
            function() {
                gsap.to(this, {
                    backgroundColor: "white",
                    y: 0,
                    boxShadow: "none",
                    duration: 0.3,
                    ease: "power2.out"
                });
            }
        );
    }
    
    // Efecto hover para tarjetas usando GSAP
    function setupCardHover() {
        $(".materials-card").hover(
            function() {
                gsap.to(this, {
                    y: -5,
                    boxShadow: "0 15px 30px rgba(0, 0, 0, 0.1)",
                    duration: 0.3,
                    ease: "power2.out"
                });
                
                // Animar la línea debajo del título
                gsap.to($(this).find('.materials-card-title::after'), {
                    width: 70,
                    duration: 0.3,
                    ease: "power1.out"
                });
                
                // Animar el borde izquierdo
                gsap.to(this, {
                    borderLeftColor: "var(--primary-color)",
                    duration: 0.3,
                    ease: "power1.out"
                });
            },
            function() {
                gsap.to(this, {
                    y: 0,
                    boxShadow: "0 10px 20px rgba(0, 0, 0, 0.05)",
                    duration: 0.3,
                    ease: "power2.out"
                });
                
                // Animar la línea debajo del título
                gsap.to($(this).find('.materials-card-title::after'), {
                    width: 40,
                    duration: 0.3,
                    ease: "power1.out"
                });
                
                // Animar el borde izquierdo
                gsap.to(this, {
                    borderLeftColor: "rgba(0,0,0,0.03)",
                    duration: 0.3,
                    ease: "power1.out"
                });
            }
        );
    }
    
    // Confirmación de eliminación con SweetAlert2
    function confirmDelete(event) {
        event.preventDefault();
        const deleteUrl = $(this).attr('href');
        const materialId = $(this).closest('tr').data('key') || $(this).closest('.materials-card').data('card-id');
        
        // Animación de entrada para SweetAlert usando Anime.js
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d63031',
            cancelButtonColor: '#636e72',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            background: '#fff',
            borderRadius: '16px',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            },
            preConfirm: () => {
                return new Promise((resolve) => {
                    // Mostrar animación de carga
                    Swal.showLoading();
                    
                    // Simular petición AJAX
                    setTimeout(() => {
                        resolve({ id: materialId });
                    }, 800);
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Animación de eliminación
                if ($(window).width() > 768) {
                    // Vista de tabla
                    const row = $("tr[data-key='" + materialId + "']");
                    
                    // Usar Anime.js para la animación de eliminación
                    anime({
                        targets: row[0],
                        translateX: -100,
                        opacity: 0,
                        easing: 'easeInOutQuad',
                        duration: 500,
                        complete: function() {
                            // Mostrar mensaje de éxito
                            Swal.fire({
                                title: '¡Eliminado!',
                                text: 'El material ha sido eliminado correctamente.',
                                icon: 'success',
                                confirmButtonColor: '#1a2a6c',
                                showClass: {
                                    popup: 'animate__animated animate__bounceIn'
                                }
                            }).then(() => {
                                // Recargar la página o eliminar la fila
                                row.remove();
                                // Opcional: location.reload();
                            });
                        }
                    });
                } else {
                    // Vista de tarjetas
                    const card = $(".materials-card[data-card-id='" + materialId + "']");
                    
                    // Usar Anime.js para la animación de eliminación
                    anime({
                        targets: card[0],
                        translateY: -20,
                        opacity: 0,
                        easing: 'easeInOutQuad',
                        duration: 500,
                        complete: function() {
                            // Mostrar mensaje de éxito
                            Swal.fire({
                                title: '¡Eliminado!',
                                text: 'El material ha sido eliminado correctamente.',
                                icon: 'success',
                                confirmButtonColor: '#1a2a6c',
                                showClass: {
                                    popup: 'animate__animated animate__bounceIn'
                                }
                            }).then(() => {
                                // Recargar la página o eliminar la tarjeta
                                card.remove();
                                // Opcional: location.reload();
                            });
                        }
                    });
                }
            }
        });
    }
    
    // Mostrar mensajes flash con animaciones
    function checkForFlashMessages() {
        const urlParams = new URLSearchParams(window.location.search);
        const success = urlParams.get('success');
        const action = urlParams.get('action');
        
        if (success === 'true' && action) {
            let title, text;
            
            if (action === 'create') {
                title = '¡Material Creado!';
                text = 'El material ha sido creado correctamente.';
            } else if (action === 'update') {
                title = '¡Material Actualizado!';
                text = 'El material ha sido actualizado correctamente.';
            }
            
            if (title && text) {
                // Usar Anime.js para animar la notificación
                setTimeout(() => {
                    Swal.fire({
                        title: title,
                        text: text,
                        icon: 'success',
                        confirmButtonColor: '#1a2a6c',
                        timer: 3000,
                        timerProgressBar: true,
                        showClass: {
                            popup: 'animate__animated animate__zoomIn'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__zoomOut'
                        },
                        didOpen: (toast) => {
                            // Animar el progreso con Anime.js
                            anime({
                                targets: '.swal2-timer-progress-bar',
                                width: '100%',
                                easing: 'linear',
                                duration: 3000
                            });
                        }
                    });
                }, 500);
            }
        }
    }
    
    // Alternar entre vista de tabla y tarjetas con animaciones mejoradas
    function setupViewToggle() {
        const toggleViewContainer = $('.toggle-view-container');
        const tableBtn = $('#table-view-btn');
        const cardBtn = $('#card-view-btn');
        const toggleSlider = $('.toggle-view-slider');
        const gridView = $('.grid-view');
        const cardView = $('.card-view');
        
        // Configurar el estado inicial
        if ($(window).width() <= 768) {
            // En móvil, siempre mostrar tarjetas
            cardView.addClass('active');
            cardBtn.addClass('active');
            toggleSlider.css('width', cardBtn.outerWidth());
            toggleSlider.css('left', cardBtn.position().left);
        } else {
            // En escritorio, mostrar tabla por defecto
            gridView.show();
            gridView.css('opacity', 1); // Asegurar que la tabla sea completamente visible
            tableBtn.addClass('active');
            toggleSlider.css('width', tableBtn.outerWidth());
            toggleSlider.css('left', tableBtn.position().left);
        }
        
        // Cambiar a vista de tabla
        tableBtn.on('click', function() {
            if (!$(this).hasClass('active')) {
                // Actualizar botones
                cardBtn.removeClass('active');
                $(this).addClass('active');
                
                // Animar el slider
                gsap.to(toggleSlider, {
                    left: $(this).position().left,
                    width: $(this).outerWidth(),
                    duration: 0.4,
                    ease: "power2.out"
                });
                
                // Animar el cambio de vista
                if (cardView.hasClass('active')) {
                    // Ocultar tarjetas
                    gsap.to(cardView.find('.materials-card'), {
                        opacity: 0,
                        y: 20,
                        stagger: 0.05,
                        duration: 0.3,
                        ease: "power1.in",
                        onComplete: function() {
                            cardView.removeClass('active');
                            
                            // Mostrar tabla - IMPORTANTE: Asegurar que sea completamente visible
                            gridView.css('display', 'block');
                            gsap.to(gridView, {
                                opacity: 1,
                                duration: 0.5,
                                ease: "power2.out",
                                onComplete: function() {
                                    // Asegurar que todas las filas sean visibles
                                    gsap.to(gridView.find('tbody tr'), {
                                        opacity: 1,
                                        height: 'auto',
                                        duration: 0.3,
                                        stagger: 0.03,
                                        ease: "power2.out",
                                        onComplete: function() {
                                            // Asegurar que todas las filas sean visibles después de la animación
                                            gridView.find('tbody tr').css({
                                                'opacity': 1,
                                                'height': 'auto',
                                                'display': 'table-row'
                                            });
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            }
        });
        
        // Cambiar a vista de tarjetas
        cardBtn.on('click', function() {
            if (!$(this).hasClass('active')) {
                // Actualizar botones
                tableBtn.removeClass('active');
                $(this).addClass('active');
                
                // Animar el slider
                gsap.to(toggleSlider, {
                    left: $(this).position().left,
                    width: $(this).outerWidth(),
                    duration: 0.4,
                    ease: "power2.out"
                });
                
                // Animar el cambio de vista
                if (gridView.is(':visible')) {
                    // Ocultar tabla
                    gsap.to(gridView, {
                        opacity: 0,
                        duration: 0.3,
                        ease: "power1.in",
                        onComplete: function() {
                            gridView.hide();
                            
                            // Mostrar tarjetas
                            cardView.addClass('active');
                            cardView.find('.materials-card').css({
                                opacity: 0,
                                transform: 'translateY(20px)'
                            });
                            
                            // Animar las tarjetas con Anime.js
                            anime({
                                targets: '.materials-card',
                                translateY: [20, 0],
                                opacity: [0, 1],
                                delay: anime.stagger(80),
                                easing: 'easeOutBack',
                                duration: 600
                            });
                        }
                    });
                }
            }
        });
    }

    function setupRealTimeSearch() {
    const searchInput = $('#global-search');
    const gridView = $('.grid-view tbody');
    const cardView = $('.card-view');
    
    searchInput.on('input', function() {
        const searchTerm = $(this).val().toLowerCase();
        
        if ($(window).width() > 768 && $('.grid-view').is(':visible')) {
            // Búsqueda en vista de tabla
            gridView.find('tr').each(function() {
                const rowText = $(this).text().toLowerCase();
                const match = rowText.includes(searchTerm);
                
                if (match) {
                    // Mostrar filas que coinciden
                    $(this).css('display', 'table-row');
                    gsap.to(this, {
                        opacity: 1,
                        height: 'auto',
                        duration: 0.3,
                        ease: "power2.out"
                    });
                } else {
                    // Ocultar filas que no coinciden
                    gsap.to(this, {
                        opacity: 0,
                        height: 0,
                        duration: 0.3,
                        ease: "power2.in",
                        onComplete: function() {
                            $(this.targets()[0]).css('display', 'none');
                        }
                    });
                }
            });
            
            // Si no hay resultados de búsqueda, mostrar un mensaje
            if (gridView.find('tr:visible').length === 0) {
                // Aquí podrías mostrar un mensaje de "No se encontraron resultados"
            }
        } else {
            // Búsqueda en vista de tarjetas
            cardView.find('.materials-card').each(function() {
                const cardText = $(this).text().toLowerCase();
                const match = cardText.includes(searchTerm);
                
                if (match) {
                    $(this).css('display', 'block');
                    anime({
                        targets: this,
                        opacity: [0, 1],
                        translateY: [10, 0],
                        duration: 300,
                        easing: 'easeOutQuad'
                    });
                } else {
                    anime({
                        targets: this,
                        opacity: [1, 0],
                        translateY: [0, 10],
                        duration: 300,
                        easing: 'easeInQuad',
                        complete: function(anim) {
                            $(anim.animatables[0].target).css('display', 'none');
                        }
                    });
                }
            });
        }
    });
    
    // Limpiar búsqueda cuando se cambia de vista
    $('#table-view-btn, #card-view-btn').on('click', function() {
        if (searchInput.val()) {
            searchInput.val('');
            // Mostrar todos los elementos
            if ($('.grid-view').is(':visible')) {
                gridView.find('tr').css({
                    'display': 'table-row',
                    'opacity': 1,
                    'height': 'auto'
                });
            } else {
                cardView.find('.materials-card').css({
                    'display': 'block',
                    'opacity': 1,
                    'transform': 'translateY(0)'
                });
            }
        }
    });
}

function resetViewState() {
    // Reiniciar estado de la tabla
    $('.grid-view tbody tr').css({
        'opacity': 1,
        'height': 'auto',
        'display': 'table-row',
        'transform': 'none',
        'background-color': 'transparent'
    });
    
    // Reiniciar estado de las tarjetas
    $('.materials-card').css({
        'opacity': 1,
        'transform': 'translateY(0)',
        'display': 'block'
    });
}

    // Inicializar todo cuando el documento esté listo
    $(document).ready(function() {
        // Animación inicial
        animatePage();
        
        // Configurar eventos
        setupTableHover();
        setupCardHover();
        $('.delete-button').on('click', confirmDelete);
        checkForFlashMessages();
        setupViewToggle();
        setupRealTimeSearch();
        resetViewState();
        
        // Efecto de carga para elementos dinámicos
        $(document).ajaxStart(function() {
            $(".grid-view, .card-view").addClass("loading-pulse");
        });
        
        $(document).ajaxStop(function() {
            $(".grid-view, .card-view").removeClass("loading-pulse");
        });
        
        // Animaciones adicionales con Anime.js
        anime({
            targets: '.action-btn',
            scale: [1, 1.1, 1],
            duration: 1500,
            delay: anime.stagger(100),
            easing: 'easeInOutQuad',
            loop: true
        });
        
        // Efecto de shimmer en los badges
        anime({
            targets: '.material-badge',
            opacity: [0.8, 1],
            easing: 'easeInOutSine',
            duration: 1500,
            loop: true
        });

        $('#table-view-btn').on('click', function() {
            setTimeout(resetViewState, 1000); // Asegurar que todo sea visible después de la transición
        });
    });
JS;

$this->registerJs($customJS);
?>

<div class="materials-container animated-element">
    <div class="materials-header animated-element">
        <h1 class="materials-title">
            <i class="fas fa-boxes-stacked mr-2"></i> 
            <?= Html::encode($this->title) ?>
        </h1>
        <p class="materials-subtitle">Gestiona tu inventario de materiales de manera eficiente</p>
    </div>

    <div class="materials-actions animated-element">
        <div class="search-container">
            <input type="text" class="search-input" id="global-search" placeholder="Buscar materiales...">
            <i class="fas fa-search search-icon"></i>
        </div>
        
        <div style="display: flex; gap: 1rem; align-items: center;">
            <div class="toggle-view-container">
                <button id="table-view-btn" class="toggle-view-btn" data-force-reset="true">
                    <i class="fas fa-table"></i> Tabla
                </button>
                <button id="card-view-btn" class="toggle-view-btn">
                    <i class="fas fa-th-large"></i> Tarjetas
                </button>
                <div class="toggle-view-slider"></div>
            </div>
            
            <?= Html::a('<i class="fas fa-plus"></i> Nuevo Material', ['create'], [
                'class' => 'btn btn-material btn-material-primary',
                'data-pjax' => '0'
            ]) ?>
        </div>
    </div>

    <!-- Vista de tabla -->
    <div class="grid-container animated-element">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{pager}",
            'tableOptions' => ['class' => 'table table-striped'],
            'rowOptions' => ['class' => 'animated-element'],
            'columns' => [
                [
                    'attribute' => 'tbl_materiales_id',
                    'label' => 'ID',
                    'headerOptions' => ['style' => 'width:80px'],
                ],
                [
                    'attribute' => 'tbl_materiales_nombre',
                    'label' => 'Nombre',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a($model->tbl_materiales_nombre, ['view', 'tbl_materiales_id' => $model->tbl_materiales_id], [
                            'data-pjax' => '0',
                            'class' => 'font-weight-bold text-decoration-none',
                            'style' => 'color: var(--text-dark);'
                        ]);
                    },
                ],
                [
                    'attribute' => 'tbl_materiales_descripcion',
                    'label' => 'Descripción',
                    'contentOptions' => ['style' => 'max-width: 250px;'],
                ],
                [
                    'attribute' => 'tbl_materiales_cantidad',
                    'label' => 'Cantidad',
                    'format' => 'raw',
                    'value' => function($model) {
                        return '<span class="material-badge material-badge-quantity">' . $model->tbl_materiales_cantidad . '</span>';
                    },
                ],
                [
                    'attribute' => 'tbl_materiales_fechaingreso',
                    'label' => 'Fecha de Ingreso',
                    'format' => 'raw',
                    'value' => function($model) {
                        return '<span class="material-badge material-badge-date">' . Yii::$app->formatter->asDate($model->tbl_materiales_fechaingreso, 'php:d M, Y') . '</span>';
                    },
                ],
                [
                    'class' => ActionColumn::className(),
                    'headerOptions' => ['class' => 'action-column'],
                    'contentOptions' => ['class' => 'action-column'],
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-eye"></i>', $url, [
                                'class' => 'action-btn action-btn-view',
                                'title' => 'Ver',
                                'data-pjax' => '0',
                            ]);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-edit"></i>', $url, [
                                'class' => 'action-btn action-btn-edit',
                                'title' => 'Editar',
                                'data-pjax' => '0',
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-trash"></i>', $url, [
                                'class' => 'action-btn action-btn-delete delete-button',
                                'title' => 'Eliminar',
                                'data-pjax' => '0',
                                
                            ]);
                        },
                    ],
                    'urlCreator' => function ($action, TblMateriales $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'tbl_materiales_id' => $model->tbl_materiales_id]);
                    }
                ],
            ],
            'emptyText' => '
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3 class="empty-state-text">No hay materiales disponibles</h3>
                    ' . Html::a('<i class="fas fa-plus"></i> Agregar Material', ['create'], ['class' => 'btn btn-material btn-material-primary']) . '
                </div>
            ',
            'emptyTextOptions' => ['class' => 'text-center p-5'],
        ]); ?>
    </div>
    
    <!-- Vista de tarjetas -->
    <div class="card-view">
        <?php if ($dataProvider->getCount() > 0): ?>
            <?php foreach ($dataProvider->getModels() as $model): ?>
                <div class="materials-card animated-element shimmer" data-card-id="<?= $model->tbl_materiales_id ?>">
                    <h3 class="materials-card-title">
                        <?= Html::a(Html::encode($model->tbl_materiales_nombre), ['view', 'tbl_materiales_id' => $model->tbl_materiales_id], [
                            'style' => 'color: inherit; text-decoration: none;',
                            'data-pjax' => '0'
                        ]) ?>
                    </h3>
                    
                    <div class="materials-card-info">
                        <div class="materials-card-item">
                            <span class="materials-card-label">ID:</span>
                            <span class="materials-card-value"><?= $model->tbl_materiales_id ?></span>
                        </div>
                        
                        <div class="materials-card-item">
                            <span class="materials-card-label">Descripción:</span>
                            <span class="materials-card-value"><?= Html::encode($model->tbl_materiales_descripcion) ?></span>
                        </div>
                        
                        <div class="materials-card-item">
                            <span class="materials-card-label">Cantidad:</span>
                            <span class="material-badge material-badge-quantity"><?= $model->tbl_materiales_cantidad ?></span>
                        </div>
                        
                        <div class="materials-card-item">
                            <span class="materials-card-label">Fecha de Ingreso:</span>
                            <span class="material-badge material-badge-date"><?= Yii::$app->formatter->asDate($model->tbl_materiales_fechaingreso, 'php:d M, Y') ?></span>
                        </div>
                    </div>
                    
                    <div class="materials-card-actions">
                        <?= Html::a('<i class="fas fa-eye"></i>', ['view', 'tbl_materiales_id' => $model->tbl_materiales_id], [
                            'class' => 'action-btn action-btn-view',
                            'title' => 'Ver',
                            'data-pjax' => '0'
                        ]) ?>
                        
                        <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'tbl_materiales_id' => $model->tbl_materiales_id], [
                            'class' => 'action-btn action-btn-edit',
                            'title' => 'Editar',
                            'data-pjax' => '0'
                        ]) ?>
                        
                        <?= Html::a('<i class="fas fa-trash"></i>', ['delete', 'tbl_materiales_id' => $model->tbl_materiales_id], [
                            'class' => 'action-btn action-btn-delete delete-button',
                            'title' => 'Eliminar',
                            'data-pjax' => '0',
                        ]) ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="pagination-container">
                <?= \yii\widgets\LinkPager::widget([
                    'pagination' => $dataProvider->pagination,
                    'options' => ['class' => 'pagination'],
                    'linkContainerOptions' => ['class' => 'page-item'],
                    'linkOptions' => ['class' => 'page-link'],
                    'disabledListItemSubTagOptions' => ['class' => 'page-link'],
                ]) ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <h3 class="empty-state-text">No hay materiales disponibles</h3>
                <?= Html::a('<i class="fas fa-plus"></i> Agregar Material', ['create'], ['class' => 'btn btn-material btn-material-primary']) ?>
            </div>
        <?php endif; ?>
    </div>
</div>