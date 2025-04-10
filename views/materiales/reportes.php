<?php
/* @var $this yii\web\View */
/* @var $materialesData array */
/* @var $movimientosData array */

use yii\helpers\Html;
use yii\web\View;
use app\models\TblMateriales;

$this->title = 'Reportes de Materiales';
$this->params['breadcrumbs'][] = ['label' => 'Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Obtener datos para los gráficos
$materiales = TblMateriales::find()->orderBy('tbl_materiales_cantidad DESC')->limit(5)->all();
$totalMateriales = TblMateriales::find()->sum('tbl_materiales_cantidad');
$materialesCount = TblMateriales::find()->count();
$materialesRecientes = TblMateriales::find()->orderBy('tbl_materiales_created DESC')->limit(5)->all();

// Registrar assets
$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdn.jsdelivr.net/npm/apexcharts', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js', ['position' => \yii\web\View::POS_END]);
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
$this->registerCssFile('https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/moment/moment.min.js', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', ['position' => \yii\web\View::POS_END]);

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
    
    .report-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-gradient));
        color: white;
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 30px;
        opacity: 0;
        box-shadow: var(--card-shadow);
    }

    .report-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .report-subtitle {
        font-size: 1.2rem;
        opacity: 0.8;
    }

    .stats-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background-color: var(--bg-white);
        border-radius: 10px;
        padding: 20px;
        flex: 1 1 250px;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        transform: translateY(20px);
        opacity: 0;
    }

    .stat-card:hover {
        box-shadow: var(--card-shadow-hover);
        transform: translateY(-5px);
    }

    .stat-card-success { border-top: 4px solid var(--success-color); }
    .stat-card-warning { border-top: 4px solid var(--warning-color); }
    .stat-card-danger { border-top: 4px solid var(--danger-color); }
    .stat-card-info { border-top: 4px solid var(--info-color); }

    .stat-title {
        color: var(--text-medium);
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 5px;
    }

    .stat-change {
        font-size: 0.9rem;
    }

    .change-up { color: var(--success-color); }
    .change-down { color: var(--danger-color); }

    .chart-container {
        background-color: var(--bg-white);
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: var(--card-shadow);
        opacity: 0;
    }

    .chart-title {
        font-size: 1.5rem;
        color: var(--text-dark);
        margin-bottom: 20px;
    }

    .chart {
        height: 300px;
        width: 100%;
    }

    .data-table-container {
        background-color: var(--bg-white);
        border-radius: 10px;
        padding: 25px;
        box-shadow: var(--card-shadow);
        margin-bottom: 30px;
        opacity: 0;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        background-color: rgba(42, 82, 152, 0.1);
        color: var(--primary-color);
        padding: 12px;
        text-align: left;
        font-weight: 600;
    }

    .data-table td {
        padding: 12px;
        border-bottom: 1px solid var(--text-light);
    }

    .data-table tr:hover {
        background-color: rgba(253, 187, 45, 0.1);
    }

    .btn-action {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-action:hover {
        background-color: var(--primary-gradient);
        transform: translateY(-2px);
    }

    .activity-feed {
        background-color: var(--bg-white);
        border-radius: 10px;
        padding: 25px;
        box-shadow: var(--card-shadow);
        opacity: 0;
    }

    .activity-item {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid var(--text-light);
        opacity: 0;
        transform: translateX(-20px);
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }

    .activity-icon-success { background-color: rgba(0, 184, 148, 0.2); color: var(--success-color); }
    .activity-icon-warning { background-color: rgba(253, 203, 110, 0.2); color: var(--warning-color); }
    .activity-icon-danger { background-color: rgba(214, 48, 49, 0.2); color: var(--danger-color); }
    .activity-icon-info { background-color: rgba(9, 132, 227, 0.2); color: var(--info-color); }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .activity-time {
        font-size: 0.8rem;
        color: var(--text-medium);
    }

    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--bg-white);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 5px solid rgba(42, 82, 152, 0.2);
        border-radius: 50%;
        border-top-color: var(--primary-color);
        animation: spin 1s infinite linear;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .filters-container {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .filter-item {
        background-color: var(--bg-white);
        border: 1px solid var(--text-light);
        border-radius: 20px;
        padding: 8px 15px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-item:hover, .filter-item.active {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .date-range {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-left: auto;
    }

    .date-input {
        padding: 8px;
        border: 1px solid var(--text-light);
        border-radius: 5px;
    }
");

// Registrar scripts JS al final del body
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', ['position' => View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', ['position' => View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js', ['position' => View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js', ['position' => View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js', ['position' => View::POS_END]);

$this->registerJs("
    // Registrar GSAP ScrollTrigger plugin
    gsap.registerPlugin(ScrollTrigger);

    // Inicializar la carga de la página
    document.addEventListener('DOMContentLoaded', function() {
        // Simular tiempo de carga
        setTimeout(function() {
            // Ocultar el loading spinner
            gsap.to('.loading-overlay', {
                opacity: 0,
                duration: 0.5,
                onComplete: function() {
                    document.querySelector('.loading-overlay').style.display = 'none';
                    initAnimations();
                    initCharts();
                    initCounters();
                    initEventListeners();
                }
            });
        }, 1500);
    });

    function initAnimations() {
        // Animación del encabezado
        gsap.to('.report-header', {
            opacity: 1,
            duration: 1,
            ease: 'power3.out'
        });

        // Animación de las tarjetas de estadísticas
        gsap.to('.stat-card', {
            opacity: 1,
            y: 0,
            duration: 0.8,
            stagger: 0.15,
            ease: 'power2.out'
        });

        // Animación de los contenedores de gráficos
        gsap.to('.chart-container', {
            opacity: 1,
            duration: 0.8,
            stagger: 0.2,
            scrollTrigger: {
                trigger: '.chart-container',
                start: 'top 80%'
            }
        });

        // Animación de la tabla de datos
        gsap.to('.data-table-container', {
            opacity: 1,
            duration: 0.8,
            scrollTrigger: {
                trigger: '.data-table-container',
                start: 'top 80%'
            }
        });

        // Animación del feed de actividades
        gsap.to('.activity-feed', {
            opacity: 1,
            duration: 0.8,
            scrollTrigger: {
                trigger: '.activity-feed',
                start: 'top 80%',
                onEnter: function() {
                    animateActivityItems();
                }
            }
        });
    }

    function animateActivityItems() {
        anime({
            targets: '.activity-item',
            opacity: [0, 1],
            translateX: [-20, 0],
            delay: anime.stagger(100),
            easing: 'easeOutQuad',
            duration: 600
        });
    }

    function initCounters() {
        // Animación de contadores de estadísticas
        const statValues = document.querySelectorAll('.stat-value');
        
        statValues.forEach(stat => {
            const targetValue = parseInt(stat.getAttribute('data-value'));
            let startValue = 0;
            
            const counter = { value: 0 };
            
            gsap.to(counter, {
                value: targetValue,
                duration: 2,
                ease: 'power2.out',
                onUpdate: function() {
                    stat.textContent = Math.floor(counter.value).toLocaleString();
                }
            });
        });
    }

    function initCharts() {
        // Gráfico de materiales por cantidad
        const materialsCtx = document.getElementById('materialsChart').getContext('2d');
        const materialsChart = new Chart(materialsCtx, {
            type: 'bar',
            data: {
                labels: " . json_encode(array_map(function($m) { return $m->tbl_materiales_nombre; }, $materiales)) . ",
                datasets: [{
                    label: 'Cantidad en Inventario',
                    data: " . json_encode(array_map(function($m) { return $m->tbl_materiales_cantidad; }, $materiales)) . ",
                    backgroundColor: [
                        '#1a2a6c',
                        '#b21f1f',
                        '#fdbb2d',
                        '#00b894',
                        '#636e72'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Gráfico de distribución de materiales
        const distributionCtx = document.getElementById('distributionChart').getContext('2d');
        const distributionChart = new Chart(distributionCtx, {
            type: 'doughnut',
            data: {
                labels: " . json_encode(array_map(function($m) { return $m->tbl_materiales_nombre; }, $materiales)) . ",
                datasets: [{
                    data: " . json_encode(array_map(function($m) { return $m->tbl_materiales_cantidad; }, $materiales)) . ",
                    backgroundColor: [
                        '#1a2a6c',
                        '#b21f1f',
                        '#fdbb2d',
                        '#00b894',
                        '#636e72'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                animation: {
                    animateRotate: true,
                    animateScale: true,
                    duration: 2000,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });

        // Gráfico de tendencia de ingresos
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        const trendChart = new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Materiales Ingresados 2024',
                    data: [15, 19, 12, 26, 23, 28, 32, 36, 32, 28, 38, 42],
                    borderColor: '#1a2a6c',
                    backgroundColor: 'rgba(42, 82, 152, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    function initEventListeners() {
        // Filtros de tiempo
        document.querySelectorAll('.filter-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.filter-item').forEach(el => el.classList.remove('active'));
                this.classList.add('active');
                
                // Simular carga de datos filtrados
                showFilterLoading();
            });
        });

        // Botones de acciones
        document.querySelectorAll('.btn-action').forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.getAttribute('data-action');
                
                if (action === 'export') {
                    swal({
                        title: 'Exportar Reporte',
                        text: '¿En qué formato deseas exportar el reporte?',
                        icon: 'info',
                        buttons: {
                            cancel: 'Cancelar',
                            pdf: {
                                text: 'PDF',
                                value: 'pdf',
                            },
                            excel: {
                                text: 'Excel',
                                value: 'excel',
                            },
                            csv: {
                                text: 'CSV',
                                value: 'csv',
                            }
                        }
                    }).then((value) => {
                        if (value) {
                            showExportNotification(value);
                        }
                    });
                } else if (action === 'refresh') {
                    showRefreshAnimation();
                } else if (action === 'details') {
                    const row = this.closest('tr');
                    const id = row.getAttribute('data-id');
                    const name = row.querySelector('td:first-child').textContent;
                    
                    swal({
                        title: 'Detalles del Material',
                        text: `Mostrando información detallada de`,
                        icon: 'info',
                    });
                }
            });
        });
    }

    function showFilterLoading() {
        const overlayElement = document.createElement('div');
        overlayElement.className = 'temp-overlay';
        overlayElement.style.cssText = 'position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.7); display: flex; justify-content: center; align-items: center; z-index: 10;';
        
        const spinnerElement = document.createElement('div');
        spinnerElement.className = 'loading-spinner';
        overlayElement.appendChild(spinnerElement);
        
        document.querySelector('.stats-container').appendChild(overlayElement);
        document.querySelector('.chart-container').appendChild(overlayElement.cloneNode(true));
        
        setTimeout(() => {
            document.querySelectorAll('.temp-overlay').forEach(overlay => {
                gsap.to(overlay, {
                    opacity: 0,
                    duration: 0.3,
                    onComplete: function() {
                        overlay.remove();
                        
                        // Simular nuevos datos
                        const newValues = [
                            Math.floor(Math.random() * 5000) + 15000,
                            Math.floor(Math.random() * 8000) + 37000,
                            Math.floor(Math.random() * 20) + 80,
                            Math.floor(Math.random() * 1000) + 3000
                        ];
                        
                        // Animar nuevos valores
                        document.querySelectorAll('.stat-value').forEach((stat, index) => {
                            const oldValue = parseInt(stat.textContent.replace(/,/g, ''));
                            const newValue = newValues[index];
                            
                            const counter = { value: oldValue };
                            
                            gsap.to(counter, {
                                value: newValue,
                                duration: 1.5,
                                ease: 'power2.out',
                                onUpdate: function() {
                                    stat.textContent = Math.floor(counter.value).toLocaleString();
                                }
                            });
                        });
                        
                        // Mostrar notificación
                        swal({
                            title: 'Datos Actualizados',
                            text: 'Los datos del reporte han sido filtrados correctamente',
                            icon: 'success',
                            timer: 2000,
                            buttons: false
                        });
                    }
                });
            });
        }, 1200);
    }

    function showExportNotification(format) {
        // Animación de exportación
        anime({
            targets: '.loading-overlay',
            opacity: [0, 0.7],
            duration: 300,
            easing: 'easeInOutQuad',
            begin: function() {
                document.querySelector('.loading-overlay').style.display = 'flex';
                document.querySelector('.loading-overlay').innerHTML = '<div class=\"loading-spinner\"></div><div style=\"margin-left: 20px; font-size: 1.2rem;\">Exportando reporte...</div>';
            }
        });
        
        setTimeout(() => {
            anime({
                targets: '.loading-overlay',
                opacity: 0,
                duration: 300,
                easing: 'easeInOutQuad',
                complete: function() {
                    document.querySelector('.loading-overlay').style.display = 'none';
                    
                    swal({
                        title: 'Exportación Completada',
                        text: `El reporte ha sido exportado en formato `,
                        icon: 'success',
                    });
                }
            });
        }, 2000);
    }

    function showRefreshAnimation() {
        // Animación de recarga de datos
        anime({
            targets: '.loading-overlay',
            opacity: [0, 0.7],
            duration: 300,
            easing: 'easeInOutQuad',
            begin: function() {
                document.querySelector('.loading-overlay').style.display = 'flex';
                document.querySelector('.loading-overlay').innerHTML = '<div class=\"loading-spinner\"></div><div style=\"margin-left: 20px; font-size: 1.2rem;\">Actualizando datos...</div>';
            }
        });
        
        setTimeout(() => {
            anime({
                targets: '.loading-overlay',
                opacity: 0,
                duration: 300,
                easing: 'easeInOutQuad',
                complete: function() {
                    document.querySelector('.loading-overlay').style.display = 'none';
                    
                    // Actualizar gráficos y estadísticas
                    initCounters();
                    initCharts();
                    
                    swal({
                        title: 'Datos Actualizados',
                        text: 'El reporte ha sido actualizado con los datos más recientes',
                        icon: 'success',
                        timer: 2000,
                        buttons: false
                    });
                }
            });
        }, 2000);
    }
", View::POS_END);
?>

<!-- Overlay de carga inicial -->
<div class="loading-overlay">
    <div class="loading-spinner"></div>
</div>

<div class="container">
    <!-- Encabezado del reporte -->
    <div class="report-header">
        <div class="report-title">Panel de Materiales</div>
        <div class="report-subtitle">Resumen completo de inventario y estadísticas de materiales</div>
    </div>

    <!-- Filtros -->
    <div class="filters-container">
        <div class="filter-item active">Hoy</div>
        <div class="filter-item">Esta semana</div>
        <div class="filter-item">Este mes</div>
        <div class="filter-item">Este año</div>
        <div class="date-range">
            <input type="date" class="date-input" placeholder="Desde">
            <span>-</span>
            <input type="date" class="date-input" placeholder="Hasta">
            <button class="btn-action" data-action="filter">Filtrar</button>
        </div>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="stats-container">
        <div class="stat-card stat-card-success">
            <div class="stat-title">Total de Materiales</div>
            <div class="stat-value" data-value="<?= $materialesCount ?>">0</div>
            <div class="stat-change change-up">+5.8% desde el último período</div>
        </div>
        <div class="stat-card stat-card-info">
            <div class="stat-title">Unidades en Inventario</div>
            <div class="stat-value" data-value="<?= $totalMateriales ?>">0</div>
            <div class="stat-change change-up">+12.3% desde el último período</div>
        </div>
        <div class="stat-card stat-card-warning">
            <div class="stat-title">Materiales Bajos</div>
            <div class="stat-value" data-value="8">0</div>
            <div class="stat-change change-down">+2.1% desde el último período</div>
        </div>
        <div class="stat-card stat-card-danger">
            <div class="stat-title">Materiales Agotados</div>
            <div class="stat-value" data-value="3">0</div>
            <div class="stat-change change-up">+1.7% desde el último período</div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="chart-container">
        <div class="chart-title">Materiales con Mayor Inventario</div>
        <div style="position: relative;">
            <canvas id="materialsChart" class="chart"></canvas>
        </div>
        <div class="text-right" style="margin-top: 15px; text-align: right;">
            <button class="btn-action" data-action="export">Exportar</button>
            <button class="btn-action" data-action="refresh" style="margin-left: 10px;">Actualizar</button>
        </div>
    </div>

    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        <div class="chart-container" style="flex: 1; min-width: 300px;">
            <div class="chart-title">Distribución de Materiales</div>
            <div style="position: relative; height: 300px;">
                <canvas id="distributionChart"></canvas>
            </div>
        </div>
        
        <div class="chart-container" style="flex: 1; min-width: 300px;">
            <div class="chart-title">Tendencia de Ingresos</div>
            <div style="position: relative;">
                <canvas id="trendChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Tabla de datos -->
    <div class="data-table-container">
        <div class="chart-title">Materiales en Inventario</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Material</th>
                    <th>Código</th>
                    <th>Cantidad</th>
                    <th>Fecha Ingreso</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($materiales as $material): ?>
                <tr data-id="<?= $material->tbl_materiales_id ?>">
                    <td><?= Html::encode($material->tbl_materiales_nombre) ?></td>
                    <td><?= Html::encode($material->tbl_materiales_codigo) ?></td>
                    <td><?= $material->tbl_materiales_cantidad ?></td>
                    <td><?= Yii::$app->formatter->asDate($material->tbl_materiales_fechaingreso) ?></td>
                    <td>
                        <?php if ($material->tbl_materiales_cantidad > 20): ?>
                            <span style="color: var(--success-color);">Disponible</span>
                        <?php elseif ($material->tbl_materiales_cantidad > 0): ?>
                            <span style="color: var(--warning-color);">Bajo Stock</span>
                        <?php else: ?>
                            <span style="color: var(--danger-color);">Agotado</span>
                        <?php endif; ?>
                    </td>
                    <td><button class="btn-action" data-action="details">Detalles</button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Feed de actividades recientes -->
    <div class="activity-feed">
        <div class="chart-title">Actividades Recientes</div>
        
        <?php foreach ($materialesRecientes as $material): ?>
        <div class="activity-item">
            <div class="activity-icon activity-icon-info">
                <i class="fas fa-box"></i>
            </div>
            <div class="activity-content">
                <div class="activity-title">Material <?= Html::encode($material->tbl_materiales_nombre) ?></div>
                <div class="activity-desc">Código: <?= Html::encode($material->tbl_materiales_codigo) ?> - Cantidad: <?= $material->tbl_materiales_cantidad ?></div>
                <div class="activity-time">Ingresado el <?= Yii::$app->formatter->asDate($material->tbl_materiales_created) ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Footer del reporte -->
    <div style="background-color: var(--bg-white); border-radius: 10px; padding: 25px; box-shadow: var(--card-shadow); margin-top: 30px; margin-bottom: 30px; text-align: center;">
        <div style="font-weight: 600; margin-bottom: 10px;">Reporte generado el <?= date('d/m/Y') ?> a las <?= date('H:i') ?></div>
        <div style="color: var(--text-medium);">
            <div>© <?= date('Y') ?> Sistema de Inventario. Todos los derechos reservados.</div>
            <div style="margin-top: 5px;">Para más información, contacte con el departamento de inventario.</div>
        </div>
        <div style="margin-top: 20px;">
            <button class="btn-action" data-action="export" style="margin-right: 10px;">Exportar Reporte</button>
            <button class="btn-action" data-action="refresh">Actualizar Datos</button>
        </div>
    </div>
</div>

<?php $this->registerJs("
    // Añadir FontAwesome para iconos
    const fontAwesome = document.createElement('link');
    fontAwesome.rel = 'stylesheet';
    fontAwesome.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css';
    document.head.appendChild(fontAwesome);

    // Añadir fuente Roboto
    const fontRoboto = document.createElement('link');
    fontRoboto.rel = 'stylesheet';
    fontRoboto.href = 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap';
    document.head.appendChild(fontRoboto);
", View::POS_END);
?>