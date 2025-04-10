<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblUsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gestión de Usuarios';
$this->params['breadcrumbs'][] = $this->title;

// Registrar assets necesarios
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
$this->registerCssFile('https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11', ['position' => \yii\web\View::POS_END]);

// CSS personalizado
$this->registerCss("
    :root {
        --primary-gradient: linear-gradient(135deg, #2c5282 0%, #1a2a6c 100%);
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
    
    .usuarios-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
        opacity: 1;
    }
    
    .usuarios-header {
        background: var(--primary-gradient);
        border-radius: 16px;
        padding: 2.5rem;
        margin-bottom: 2.5rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(26, 42, 108, 0.15);
        transform: translateY(20px);
        opacity: 0;
    }
    
    .usuarios-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: rgba(255, 255, 255, 0.1);
        transform: rotate(30deg);
    }
    
    .usuarios-title {
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .usuarios-subtitle {
        color: rgba(255, 255, 255, 0.9);
        margin-top: 0.5rem;
        font-size: 1.1rem;
        position: relative;
        z-index: 1;
        font-weight: 300;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }
    
    .stat-card {
        background-color: var(--bg-white);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        transform: translateY(20px);
        opacity: 0;
    }
    
    .stat-card:hover {
        transform: translateY(-5px) !important;
        box-shadow: var(--card-shadow-hover);
    }
    
    .stat-card::before {
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
    
    .stat-card:hover::before {
        transform: scaleY(1);
    }
    
    .stat-card-1::before { background: linear-gradient(to bottom, #2c5282, #1a2a6c); }
    .stat-card-2::before { background: linear-gradient(to bottom, #b21f1f, #e74c3c); }
    .stat-card-3::before { background: linear-gradient(to bottom, #fdbb2d, #f39c12); }
    .stat-card-4::before { background: linear-gradient(to bottom, #00b894, #20bf6b); }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        color: white;
        font-size: 1.5rem;
    }
    
    .stat-icon-1 { background: linear-gradient(135deg, #2c5282, #1a2a6c); }
    .stat-icon-2 { background: linear-gradient(135deg, #b21f1f, #e74c3c); }
    .stat-icon-3 { background: linear-gradient(135deg, #fdbb2d, #f39c12); }
    .stat-icon-4 { background: linear-gradient(135deg, #00b894, #20bf6b); }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        font-size: 0.9rem;
        color: var(--text-medium);
        margin-bottom: 0.5rem;
    }
    
    .stat-change {
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .stat-change-positive {
        color: var(--success-color);
    }
    
    .stat-change-negative {
        color: var(--danger-color);
    }
    
    .actions-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
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
    
    .btn-usuario {
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
    
    .btn-usuario-primary {
        background: var(--primary-gradient);
        color: white;
    }
    
    .btn-usuario-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 14px rgba(26, 42, 108, 0.2);
    }
    
    .btn-usuario-secondary {
        background: var(--bg-white);
        color: var(--primary-color);
        border: 1px solid rgba(26, 42, 108, 0.2);
    }
    
    .btn-usuario-secondary:hover {
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
    
    .usuario-badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .usuario-badge-admin {
        background-color: rgba(26, 42, 108, 0.1);
        color: var(--primary-color);
    }
    
    .usuario-badge-regular {
        background-color: rgba(9, 132, 227, 0.1);
        color: var(--info-color);
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
    
    /* Responsive styles */
    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .usuarios-header {
            padding: 1.5rem;
        }
        
        .usuarios-title {
            font-size: 1.8rem;
        }
        
        .actions-container {
            flex-direction: column;
            align-items: stretch;
        }
        
        .search-container {
            max-width: 100%;
            margin-bottom: 1rem;
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
");

// JavaScript personalizado
$customJS = <<<JS
    // Inicializar AOS
    AOS.init({
        duration: 800,
        easing: 'ease-out',
        once: false,
        mirror: true
    });
    
    // Inicializar GSAP y ScrollTrigger
    gsap.registerPlugin(ScrollTrigger);
    
    // Función para animar la página
    function animatePage() {
        // Timeline principal
        const mainTl = gsap.timeline();
        
        // Mostrar el contenedor principal con un fade in
        mainTl.to(".usuarios-container", {
            opacity: 1,
            duration: 0.8,
            ease: "power2.out"
        });
        
        // Animación del encabezado con un efecto de rebote suave
        mainTl.to(".usuarios-header", {
            y: 0,
            opacity: 1,
            duration: 1,
            ease: "back.out(1.4)",
        }, "-=0.4");
        
        // Animar el título con un efecto de texto que se escribe
        const titleText = document.querySelector('.usuarios-title').textContent;
        document.querySelector('.usuarios-title').innerHTML = '';
        document.querySelector('.usuarios-title').style.opacity = 1;
        
        let titleHTML = '';
        for (let i = 0; i < titleText.length; i++) {
            titleHTML += '<span style="opacity: 0; display: inline-block;">' + titleText[i] + '</span>';
        }
        document.querySelector('.usuarios-title').innerHTML = titleHTML;
        
        mainTl.to(".usuarios-title span", {
            opacity: 1,
            stagger: 0.03,
            duration: 0.1,
            ease: "power1.out",
        }, "-=0.6");
        
        // Animar el subtítulo con un fade in
        mainTl.to(".usuarios-subtitle", {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: "power2.out",
        }, "-=0.4");
        
        // Animar las tarjetas de estadísticas
        mainTl.to(".stat-card", {
            y: 0,
            opacity: 1,
            stagger: 0.1,
            duration: 0.8,
            ease: "back.out(1.2)",
        }, "-=0.4");
        
        // Animar el contenedor de acciones
        mainTl.to(".actions-container", {
            y: 0,
            opacity: 1,
            duration: 0.8,
            ease: "power2.out",
        }, "-=0.6");
        
        // Animar la tabla
        mainTl.to(".grid-container", {
            y: 0,
            opacity: 1,
            duration: 0.8,
            ease: "power2.out",
            onComplete: animateTableRows
        }, "-=0.4");
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
    
    // Confirmación de eliminación con SweetAlert2
    function confirmDelete(event) {
        event.preventDefault();
        const deleteUrl = $(this).attr('href');
        const userName = $(this).closest('tr').find('td:nth-child(3)').text() + ' ' + 
                        $(this).closest('tr').find('td:nth-child(4)').text();
        
        Swal.fire({
            title: '¿Estás seguro?',
            html: 'Esta acción eliminará al usuario <strong>' + userName + '</strong>',
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
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Mostrar animación de carga
                Swal.fire({
                    title: 'Eliminando...',
                    text: 'Procesando la solicitud',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Enviar solicitud AJAX para eliminar
                $.ajax({
                    url: deleteUrl,
                    type: 'POST',
                    success: function(response) {
                        // Animar la fila que se elimina
                        const row = $(event.target).closest('tr');
                        
                        gsap.to(row, {
                            opacity: 0,
                            x: -100,
                            duration: 0.5,
                            ease: "power2.in",
                            onComplete: function() {
                                row.remove();
                                
                                // Mostrar mensaje de éxito
                                Swal.fire({
                                    title: '¡Eliminado!',
                                    text: 'El usuario ha sido eliminado correctamente.',
                                    icon: 'success',
                                    confirmButtonColor: '#1a2a6c'
                                });
                                
                                // Actualizar contador de usuarios
                                updateUserCount();
                            }
                        });
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo eliminar el usuario. Inténtalo de nuevo.',
                            icon: 'error',
                            confirmButtonColor: '#1a2a6c'
                        });
                    }
                });
            }
        });
    }
    
    // Actualizar contador de usuarios
    function updateUserCount() {
        const totalUsers = $(".grid-view tbody tr").length;
        $(".total-users").text(totalUsers);
        
        // Animar el cambio
        gsap.from(".total-users", {
            scale: 1.5,
            duration: 0.5,
            ease: "elastic.out(1, 0.5)"
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
                title = '¡Usuario Creado!';
                text = 'El usuario ha sido creado correctamente.';
            } else if (action === 'update') {
                title = '¡Usuario Actualizado!';
                text = 'El usuario ha sido actualizado correctamente.';
            }
            
            if (title && text) {
                setTimeout(() => {
                    Swal.fire({
                        title: title,
                        text: text,
                        icon: 'success',
                        confirmButtonColor: '#1a2a6c',
                        timer: 3000,
                        timerProgressBar: true
                    });
                }, 500);
            }
        }
    }
    
    // Búsqueda en tiempo real
    function setupRealTimeSearch() {
        $("#global-search").on("input", function() {
            const searchTerm = $(this).val().toLowerCase();
            
            $(".grid-view tbody tr").each(function() {
                const rowText = $(this).text().toLowerCase();
                const match = rowText.includes(searchTerm);
                
                if (match) {
                    $(this).show();
                    gsap.to(this, {
                        opacity: 1,
                        x: 0,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                } else {
                    gsap.to(this, {
                        opacity: 0,
                        x: -20,
                        duration: 0.3,
                        ease: "power2.in",
                        onComplete: function() {
                            $(this.targets()[0]).hide();
                        }
                    });
                }
            });
        });
    }
    
    // Animaciones para los botones de acción
    function setupActionButtons() {
        $(".action-btn").hover(
            function() {
                gsap.to(this, {
                    y: -3,
                    scale: 1.1,
                    boxShadow: "0 5px 15px rgba(0, 0, 0, 0.1)",
                    duration: 0.3,
                    ease: "power2.out"
                });
            },
            function() {
                gsap.to(this, {
                    y: 0,
                    scale: 1,
                    boxShadow: "none",
                    duration: 0.3,
                    ease: "power2.out"
                });
            }
        );
    }
    
    // Animaciones para las tarjetas de estadísticas
    function setupStatCards() {
        $(".stat-card").hover(
            function() {
                gsap.to(this, {
                    y: -5,
                    boxShadow: "0 15px 30px rgba(0, 0, 0, 0.1)",
                    duration: 0.3,
                    ease: "power2.out"
                });
                
                gsap.to($(this).find(".stat-icon"), {
                    scale: 1.1,
                    duration: 0.3,
                    ease: "back.out(1.5)"
                });
                
                // Animar la línea lateral
                gsap.to(this, {
                    "--before-scale-y": 1,
                    duration: 0.4,
                    ease: "power2.out"
                });
            },
            function() {
                gsap.to(this, {
                    y: 0,
                    boxShadow: "0 10px 20px rgba(0, 0, 0, 0.05)",
                    duration: 0.3,
                    ease: "power2.out"
                });
                
                gsap.to($(this).find(".stat-icon"), {
                    scale: 1,
                    duration: 0.3,
                    ease: "power2.out"
                });
                
                // Animar la línea lateral
                gsap.to(this, {
                    "--before-scale-y": 0,
                    duration: 0.4,
                    ease: "power2.out"
                });
            }
        );
    }
    
    // Inicializar todo cuando el documento esté listo
    $(document).ready(function() {
        // Animación inicial
        animatePage();
        
        // Configurar eventos
        setupTableHover();
        setupActionButtons();
        setupStatCards();
        setupRealTimeSearch();
        
        // Configurar eliminación con confirmación
        $(".delete-button").on("click", confirmDelete);
        
        // Verificar mensajes flash
        checkForFlashMessages();
        
        // Actualizar contador de usuarios
        updateUserCount();
        
        // Animaciones adicionales
        gsap.to(".float-animation", {
            y: -10,
            duration: 2,
            repeat: -1,
            yoyo: true,
            ease: "power1.inOut"
        });
        
        // Animaciones al hacer scroll
        ScrollTrigger.batch(".animated-on-scroll", {
            onEnter: batch => {
                gsap.to(batch, {
                    opacity: 1,
                    y: 0,
                    stagger: 0.15,
                    duration: 0.8,
                    ease: "back.out(1.2)"
                });
            },
            once: false
        });
    });
JS;

$this->registerJs($customJS);

// Obtener estadísticas de usuarios
$totalUsuarios = $dataProvider->getTotalCount();
$adminCount = Yii::$app->db->createCommand('SELECT COUNT(*) FROM tbl_usuarios WHERE tbl_usuarios_rol = "admin"')->queryScalar();
$newUsersThisMonth = Yii::$app->db->createCommand('SELECT COUNT(*) FROM tbl_usuarios WHERE MONTH(tbl_usuarios_created) = MONTH(CURRENT_DATE()) AND YEAR(tbl_usuarios_created) = YEAR(CURRENT_DATE())')->queryScalar();

?>

<div class="usuarios-container animated-element">
    <div class="usuarios-header animated-element">
        <h1 class="usuarios-title">
            <i class="fas fa-users mr-2"></i> 
            <?= Html::encode($this->title) ?>
        </h1>
        <p class="usuarios-subtitle">Administra los usuarios del sistema de forma eficiente</p>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="stats-grid">
        <div class="stat-card stat-card-1 animated-element" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-icon stat-icon-1">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-value total-users"><?= $totalUsuarios ?></div>
            <div class="stat-label">Total de usuarios</div>
            <div class="stat-change stat-change-positive">
                <i class="fas fa-arrow-up"></i> 12% desde el mes pasado
            </div>
        </div>
        <div class="stat-card stat-card-2 animated-element" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-icon stat-icon-2">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="stat-value"><?= $adminCount ?></div>
            <div class="stat-label">Administradores</div>
            <div class="stat-change stat-change-positive">
                <i class="fas fa-arrow-up"></i> 5% desde el mes pasado
            </div>
        </div>
        <div class="stat-card stat-card-3 animated-element" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-icon stat-icon-3">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="stat-value"><?= $newUsersThisMonth ?></div>
            <div class="stat-label">Nuevos este mes</div>
            <div class="stat-change stat-change-positive">
                <i class="fas fa-arrow-up"></i> 18% desde el mes pasado
            </div>
        </div>
    
    </div>

    <!-- Acciones y búsqueda -->
    <div class="actions-container animated-element" data-aos="fade-up" data-aos-delay="500">
        <div class="search-container">
            <input type="text" class="search-input" id="global-search" placeholder="Buscar usuarios...">
            <i class="fas fa-search search-icon"></i>
        </div>
        
        <div style="display: flex; gap: 1rem; align-items: center;">
            <button class="btn-usuario btn-usuario-secondary float-animation">
                <i class="fas fa-filter"></i> Filtrar
            </button>
            
            <?= Html::a('<i class="fas fa-plus"></i> Nuevo Usuario', ['create'], [
                'class' => 'btn-usuario btn-usuario-primary float-animation',
                'data-aos' => 'zoom-in',
                'data-aos-delay' => '600'
            ]) ?>
        </div>
    </div>

    <!-- Tabla de usuarios -->
    <div class="grid-container animated-element" data-aos="fade-up" data-aos-delay="700">
        <?php Pjax::begin(['id' => 'usuarios-grid']); ?>
        
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{pager}",
            'tableOptions' => ['class' => 'table table-striped'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'tbl_usuarios_id',
                    'headerOptions' => ['style' => 'width:80px'],
                ],
                [
                    'attribute' => 'tbl_usuarios_nombre',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a($model->tbl_usuarios_nombre, ['view', 'tbl_usuarios_id' => $model->tbl_usuarios_id], [
                            'data-pjax' => '0',
                            'class' => 'font-weight-bold text-decoration-none',
                            'style' => 'color: var(--text-dark);'
                        ]);
                    },
                ],
                'tbl_usuarios_apellido',
                'tbl_usuarios_email:email',
                'tbl_usuarios_telefono',
                [
                    'attribute' => 'tbl_usuarios_rol',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if ($model->tbl_usuarios_rol === 'admin') {
                            return '<span class="usuario-badge usuario-badge-admin">Administrador</span>';
                        } else {
                            return '<span class="usuario-badge usuario-badge-regular">Usuario Regular</span>';
                        }
                    },
                    'filter' => [
                        'admin' => 'Administrador',
                        'usuario' => 'Usuario Regular',
                    ],
                ],
                [
                    'attribute' => 'tbl_usuarios_created',
                    'format' => 'date',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
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
                ],
            ],
            'emptyText' => '
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-users-slash"></i>
                    </div>
                    <h3 class="empty-state-text">No hay usuarios disponibles</h3>
                    ' . Html::a('<i class="fas fa-plus"></i> Agregar Usuario', ['create'], ['class' => 'btn-usuario btn-usuario-primary']) . '
                </div>
            ',
            'emptyTextOptions' => ['class' => 'text-center p-5'],
        ]); ?>
        
        <?php Pjax::end(); ?>
    </div>
</div>
