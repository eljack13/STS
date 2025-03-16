
<?php
use yii\helpers\Html;
use yii\helpers\Url;




$this->title = 'Sistema de Gestión de Materiales';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
$this->registerCssFile('https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css');
?>

<div class="materiales-index">
    <!-- Hero Section -->
    <div class="jumbotron bg-primary text-white text-center p-5 mb-4 rounded-3 shadow animate__animated animate__fadeIn">
        <h1 class="display-4"><i class="fas fa-boxes"></i> Sistema de Gestión de Materiales</h1>
        <p class="lead">Plataforma integral para administrar el inventario de materiales de manera eficiente</p>
    </div>


    <!-- Main Options -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card shadow animate__animated animate__fadeInLeft">
                <div class="card-header bg-dark text-white">
                    <h3><i class="fas fa-cogs"></i> Operaciones Principales</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 border-primary hover-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-plus-circle fa-4x text-primary mb-3"></i>
                                    <h4>Registrar Material</h4>
                                    <p>Añade nuevos materiales al sistema con toda su información</p>
                                    <?= Html::a('Registrar Ahora', ['materiales/create'], ['class' => 'btn btn-primary btn-lg mt-2']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 border-success hover-card">
                                <div class="card-body text-center">
                                    <i class="fas fa-list-ul fa-4x text-success mb-3"></i>
                                    <h4>Inventario Completo</h4>
                                    <p>Visualiza todos los materiales registrados en el sistema</p>
                                    <?= Html::a('Ver Inventario', ['materiales/index'], ['class' => 'btn btn-success btn-lg mt-2']) ?>
                                </div>
                            </div>
                        </div>
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    

<?php $this->registerJs("
    // Hover effects
    $('.hover-card').hover(
        function() { $(this).addClass('shadow-lg').css('cursor', 'pointer'); },
        function() { $(this).removeClass('shadow-lg'); }
    );
    
    // Initialize any tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle=\"tooltip\"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
"); ?>

<style>
.hover-card {
    transition: all 0.3s;
}
.hover-card:hover {
    transform: translateY(-5px);
}
.jumbotron {
    background: linear-gradient(135deg, #0d6efd, #0a58ca);
}
.card {
    margin-bottom: 15px;
    border-radius: 10px;
}
.card-header {
    border-radius: 10px 10px 0 0!important;
}
</style>