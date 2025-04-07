<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TblMateriales $model */

$this->title = $model->tbl_materiales_nombre;
$this->params['breadcrumbs'][] = ['label' => 'Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

// Register SweetAlert2
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11', ['position' => \yii\web\View::POS_END]);

// Register GSAP for animations
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', ['position' => \yii\web\View::POS_END]);

// Register Font Awesome
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

// Custom CSS
$this->registerCss("
    body {
        background-color: #f8f9fa;
    }
    
    .material-view-container {
        padding: 2rem 0;
    }
    
    .material-card {
        background-color: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .material-header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
    }
    
    .material-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: rgba(255, 255, 255, 0.1);
        transform: rotate(30deg);
    }
    
    .material-title {
        color: white;
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .material-icon {
        background-color: rgba(255, 255, 255, 0.2);
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .material-id {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1rem;
        margin-top: 0.5rem;
        position: relative;
        z-index: 1;
    }
    
    .material-actions {
        padding: 1.5rem;
        background-color: #f8f9fa;
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .btn-material {
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .btn-material-primary {
        background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
        color: white;
        border: none;
    }
    
    .btn-material-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 14px rgba(37, 117, 252, 0.25);
    }
    
    .btn-material-danger {
        background-color: #e74c3c;
        color: white;
        border: none;
    }
    
    .btn-material-danger:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 14px rgba(231, 76, 60, 0.25);
    }
    
    .btn-material-secondary {
        background-color: #ecf0f1;
        color: #34495e;
        border: none;
    }
    
    .btn-material-secondary:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 14px rgba(0, 0, 0, 0.1);
        background-color: #dfe6e9;
    }
    
    .material-content {
        padding: 2rem;
    }
    
    .detail-view {
        border: none;
        background-color: transparent;
    }
    
    .detail-view th {
        width: 30%;
        padding: 1.25rem 1rem;
        background-color: #f8f9fa;
        border-radius: 8px 0 0 8px;
        border: none;
        color: #2c3e50;
        font-weight: 600;
    }
    
    .detail-view td {
        padding: 1.25rem 1rem;
        border: none;
        background-color: white;
        border-radius: 0 8px 8px 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    
    .detail-view tr {
        margin-bottom: 1rem;
        display: flex;
    }
    
    .detail-view tr:last-child {
        margin-bottom: 0;
    }
    
    .material-badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .material-badge-quantity {
        background-color: #e3f2fd;
        color: #1976d2;
    }
    
    .material-badge-date {
        background-color: #e8f5e9;
        color: #388e3c;
    }
    
    .material-section {
        margin-top: 2rem;
    }
    
    .material-section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f1f2f6;
    }
    
    .material-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    .stat-card {
        background-color: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        color: white;
        font-size: 1.25rem;
    }
    
    .stat-icon-quantity {
        background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
    }
    
    .stat-icon-date {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }
    
    .stat-icon-created {
        background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
    }
    
    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        color: #7f8c8d;
        font-size: 0.9rem;
    }
    
    @media (max-width: 768px) {
        .material-header {
            padding: 1.5rem;
        }
        
        .material-title {
            font-size: 1.5rem;
        }
        
        .material-icon {
            width: 45px;
            height: 45px;
            font-size: 1.2rem;
        }
        
        .material-actions {
            flex-wrap: wrap;
        }
        
        .btn-material {
            width: 100%;
            justify-content: center;
        }
        
        .detail-view th,
        .detail-view td {
            padding: 1rem;
        }
        
        .detail-view tr {
            flex-direction: column;
        }
        
        .detail-view th {
            border-radius: 8px 8px 0 0;
            width: 100%;
        }
        
        .detail-view td {
            border-radius: 0 0 8px 8px;
            width: 100%;
        }
    }
");

// Custom JS
$customJS = <<<JS
    // Delete confirmation with SweetAlert2
    function confirmDelete(event) {
        event.preventDefault();
        const deleteUrl = $(this).attr('href');
        
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#7f8c8d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            background: '#fff',
            borderRadius: 10,
            customClass: {
                confirmButton: 'btn btn-material btn-material-danger',
                cancelButton: 'btn btn-material btn-material-secondary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(deleteUrl, {}, function(data) {
                    Swal.fire({
                        title: '¡Eliminado!',
                        text: 'El material ha sido eliminado correctamente.',
                        icon: 'success',
                        confirmButtonColor: '#3498db'
                    }).then(() => {
                        window.location.href = 'index';
                    });
                });
            }
        });
    }
    
    // GSAP Animations
    function animateElements() {
        gsap.from(".material-card", {duration: 0.8, y: 30, opacity: 0, ease: "power3.out"});
        gsap.from(".material-title", {duration: 0.6, y: 20, opacity: 0, delay: 0.3, ease: "back.out(1.7)"});
        gsap.from(".material-id", {duration: 0.6, y: 20, opacity: 0, delay: 0.4, ease: "back.out(1.7)"});
        gsap.from(".material-actions", {duration: 0.5, y: 15, opacity: 0, delay: 0.6, ease: "power2.out"});
        gsap.from(".material-content", {duration: 0.7, y: 20, opacity: 0, delay: 0.7, ease: "power3.out"});
        gsap.from(".stat-card", {duration: 0.5, y: 20, opacity: 0, stagger: 0.1, delay: 0.9, ease: "back.out(1.7)"});
    }
    
    $(document).ready(function() {
        // Initialize animations
        animateElements();
        
        // Setup delete confirmation
        $('.delete-button').on('click', confirmDelete);
        
        // Animate stat cards on hover
        $('.stat-card').hover(
            function() {
                gsap.to($(this), {duration: 0.3, y: -5, boxShadow: '0 10px 25px rgba(0,0,0,0.1)'});
            },
            function() {
                gsap.to($(this), {duration: 0.3, y: 0, boxShadow: '0 5px 15px rgba(0,0,0,0.05)'});
            }
        );
    });
JS;

$this->registerJs($customJS);
?>

<div class="material-view-container">
    <div class="material-card">
        <div class="material-header">
            <h1 class="material-title">
                <div class="material-icon">
                    <i class="fas fa-box"></i>
                </div>
                <?= Html::encode($model->tbl_materiales_nombre) ?>
            </h1>
            <div class="material-id">ID: <?= $model->tbl_materiales_id ?></div>
        </div>
        
        <div class="material-actions">
            <?= Html::a('<i class="fas fa-arrow-left"></i> Volver', ['index'], ['class' => 'btn btn-material btn-material-secondary']) ?>
            <?= Html::a('<i class="fas fa-edit"></i> Editar', ['update', 'tbl_materiales_id' => $model->tbl_materiales_id], ['class' => 'btn btn-material btn-material-primary']) ?>
            <?= Html::a('<i class="fas fa-trash"></i> Eliminar', ['delete', 'tbl_materiales_id' => $model->tbl_materiales_id], [
                'class' => 'btn btn-material btn-material-danger delete-button',
                'data' => [
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        
        <div class="material-content">
            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'detail-view'],
                'template' => '<tr><th{captionOptions}>{label}</th><td{contentOptions}>{value}</td></tr>',
                'attributes' => [
                    [
                        'attribute' => 'tbl_materiales_nombre',
                        'label' => 'Nombre',
                    ],
                    [
                        'attribute' => 'tbl_materiales_descripcion',
                        'label' => 'Descripción',
                        'format' => 'ntext',
                    ],
                    [
                        'attribute' => 'tbl_materiales_cantidad',
                        'label' => 'Cantidad',
                        'value' => function($model) {
                            return '<span class="material-badge material-badge-quantity">' . $model->tbl_materiales_cantidad . '</span>';
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'tbl_materiales_fechaingreso',
                        'label' => 'Fecha de Ingreso',
                        'value' => function($model) {
                            return '<span class="material-badge material-badge-date">' . Yii::$app->formatter->asDate($model->tbl_materiales_fechaingreso, 'php:d M, Y') . '</span>';
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'tbl_materiales_created',
                        'label' => 'Creado',
                        'value' => Yii::$app->formatter->asDatetime($model->tbl_materiales_created, 'php:d M, Y H:i'),
                    ],
                    [
                        'attribute' => 'tbl_materiales_createdby',
                        'label' => 'Creado por',
                    ],
                ],
            ]) ?>
            
            <div class="material-section">
                <h2 class="material-section-title">Resumen</h2>
                
                <div class="material-stats">
                    <div class="stat-card">
                        <div class="stat-icon stat-icon-quantity">
                            <i class="fas fa-cubes"></i>
                        </div>
                        <div class="stat-value"><?= $model->tbl_materiales_cantidad ?></div>
                        <div class="stat-label">Unidades disponibles</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon stat-icon-date">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-value"><?= Yii::$app->formatter->asDate($model->tbl_materiales_fechaingreso, 'php:d M, Y') ?></div>
                        <div class="stat-label">Fecha de ingreso</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon stat-icon-created">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-value"><?= Yii::$app->formatter->asDate($model->tbl_materiales_created) ?></div>
                        <div class="stat-label">Fecha de creación</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>