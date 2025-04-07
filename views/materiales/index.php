<?php

use app\models\TblMateriales;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TblMaterialesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Inventario de Materiales';
$this->params['breadcrumbs'][] = $this->title;

// Register SweetAlert2
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11', ['position' => \yii\web\View::POS_END]);

// Register GSAP for animations
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', ['position' => \yii\web\View::POS_END]);

// Register Font Awesome
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

// Register Barba.js for page transitions
$this->registerJsFile('https://unpkg.com/@barba/core', ['position' => \yii\web\View::POS_END]);

// Custom CSS
$this->registerCss("
    body {
        background-color: #f8f9fa;
    }
    
    .materials-container {
        padding: 2rem 0;
    }
    
    .materials-header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        border-radius: 16px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(37, 117, 252, 0.2);
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
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 1;
    }
    
    .materials-subtitle {
        color: rgba(255, 255, 255, 0.85);
        margin-top: 0.5rem;
        font-size: 1.1rem;
        position: relative;
        z-index: 1;
    }
    
    .materials-actions {
        margin: 1.5rem 0;
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
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
        border: 1px solid #e0e0e0;
        background-color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
        transition: all 0.3s ease;
    }
    
    .search-input:focus {
        box-shadow: 0 4px 15px rgba(37, 117, 252, 0.15);
        border-color: #2575fc;
        outline: none;
    }
    
    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
    
    .btn-material {
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
    
    .grid-container {
        background-color: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }
    
    .grid-view {
        padding: 0;
        border: none;
    }
    
    .grid-view .table {
        margin-bottom: 0;
    }
    
    .grid-view .table th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        border-top: none;
        padding: 1rem;
    }
    
    .grid-view .table td {
        padding: 1rem;
        vertical-align: middle;
    }
    
    .grid-view .table tr:hover {
        background-color: #f8f9fa;
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
        transition: all 0.2s ease;
        color: white;
    }
    
    .action-btn:hover {
        transform: translateY(-3px);
    }
    
    .action-btn-view {
        background-color: #3498db;
    }
    
    .action-btn-edit {
        background-color: #f39c12;
    }
    
    .action-btn-delete {
        background-color: #e74c3c;
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
        color: #495057;
        border: none;
        background-color: #f8f9fa;
        transition: all 0.2s ease;
    }
    
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
        color: white;
        box-shadow: 0 4px 10px rgba(37, 117, 252, 0.3);
    }
    
    .pagination .page-item .page-link:hover {
        background-color: #e9ecef;
        transform: translateY(-2px);
    }
    
    .pagination .page-item.active .page-link:hover {
        background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem;
    }
    
    .empty-state-icon {
        font-size: 4rem;
        color: #d1d8e0;
        margin-bottom: 1rem;
    }
    
    .empty-state-text {
        color: #8395a7;
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
    }
    
    /* Card view for mobile */
    @media (max-width: 768px) {
        .materials-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }
        
        .materials-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .materials-card-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #2c3e50;
        }
        
        .materials-card-info {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }
        
        .materials-card-item {
            display: flex;
            justify-content: space-between;
        }
        
        .materials-card-label {
            color: #7f8c8d;
            font-size: 0.9rem;
        }
        
        .materials-card-value {
            font-weight: 500;
            color: #34495e;
        }
        
        .materials-card-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #ecf0f1;
        }
        
        .grid-view {
            display: none;
        }
        
        .card-view {
            display: block;
        }
    }
    
    @media (min-width: 769px) {
        .grid-view {
            display: block;
        }
        
        .card-view {
            display: none;
        }
    }
");

// Custom JS
$customJS = <<<JS
    // Initialize Barba.js for page transitions
    barba.init({
        transitions: [{
            name: 'opacity-transition',
            leave(data) {
                return gsap.to(data.current.container, {
                    opacity: 0,
                    duration: 0.5
                });
            },
            enter(data) {
                return gsap.from(data.next.container, {
                    opacity: 0,
                    duration: 0.5
                });
            }
        }]
    });
    
    // GSAP Animations
    function animateElements() {
        gsap.from(".materials-header", {duration: 1, y: 30, opacity: 0, ease: "power3.out"});
        gsap.from(".materials-title", {duration: 0.8, y: 20, opacity: 0, delay: 0.3, ease: "back.out(1.7)"});
        gsap.from(".materials-subtitle", {duration: 0.8, y: 20, opacity: 0, delay: 0.4, ease: "back.out(1.7)"});
        gsap.from(".materials-actions", {duration: 0.6, y: 20, opacity: 0, delay: 0.6, ease: "power2.out"});
        gsap.from(".grid-container", {duration: 0.8, y: 30, opacity: 0, delay: 0.8, ease: "power3.out"});
        gsap.from(".materials-card", {duration: 0.6, y: 20, opacity: 0, stagger: 0.1, delay: 0.8, ease: "power2.out"});
    }
    
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
                cancelButton: 'btn btn-material btn-material-back'
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
                        window.location.reload();
                    });
                });
            }
        });
    }
    
    // Show success message when returning from create/update
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
                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'success',
                    confirmButtonColor: '#3498db',
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        }
    }
    
    // Toggle between grid and card view
    function setupViewToggle() {
        $('#toggle-view').on('click', function() {
            $('.grid-view').toggle();
            $('.card-view').toggle();
            
            if ($('.grid-view').is(':visible')) {
                $(this).html('<i class="fas fa-th-large"></i> Ver como Tarjetas');
            } else {
                $(this).html('<i class="fas fa-table"></i> Ver como Tabla');
            }
        });
    }
    
    // Initialize everything when document is ready
    $(document).ready(function() {
        animateElements();
        $('.delete-button').on('click', confirmDelete);
        checkForFlashMessages();
        setupViewToggle();
        
        // Animate rows on hover
        $('.grid-view tbody tr').hover(
            function() {
                gsap.to($(this), {duration: 0.3, backgroundColor: '#f8f9fa', boxShadow: '0 4px 10px rgba(0,0,0,0.05)'});
            },
            function() {
                gsap.to($(this), {duration: 0.3, backgroundColor: 'white', boxShadow: 'none'});
            }
        );
        
        // Animate cards on hover
        $('.materials-card').hover(
            function() {
                gsap.to($(this), {duration: 0.3, y: -5, boxShadow: '0 10px 25px rgba(0,0,0,0.1)'});
            },
            function() {
                gsap.to($(this), {duration: 0.3, y: 0, boxShadow: '0 4px 15px rgba(0,0,0,0.05)'});
            }
        );
    });
JS;

$this->registerJs($customJS);
?>

<div class="materials-container" data-barba="container" data-barba-namespace="materials-index">
    <div class="materials-header">
        <h1 class="materials-title">
            <i class="fas fa-boxes-stacked mr-2"></i> 
            <?= Html::encode($this->title) ?>
        </h1>
        <p class="materials-subtitle">Gestiona tu inventario de materiales de manera eficiente</p>
    </div>

    <div class="materials-actions">
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" id="global-search" placeholder="Buscar materiales...">
        </div>
        
        <div>
            <button id="toggle-view" class="btn btn-outline-secondary mr-2">
                <i class="fas fa-th-large"></i> Ver como Tarjetas
            </button>
            
            <?= Html::a('<i class="fas fa-plus"></i> Nuevo Material', ['create'], ['class' => 'btn btn-material btn-material-primary']) ?>
        </div>
    </div>

    <div class="grid-container grid-view">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{pager}",
            'tableOptions' => ['class' => 'table table-striped'],
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
                            'style' => 'color: #2c3e50;'
                        ]);
                    },
                ],
                [
                    'attribute' => 'tbl_materiales_descripcion',
                    'label' => 'Descripción',
                    'contentOptions' => ['style' => 'max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'],
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
    
    <!-- Card View for Mobile -->
    <div class="card-view">
        <?php if ($dataProvider->getCount() > 0): ?>
            <?php foreach ($dataProvider->getModels() as $model): ?>
                <div class="materials-card">
                    <h3 class="materials-card-title"><?= Html::encode($model->tbl_materiales_nombre) ?></h3>
                    
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
                        ]) ?>
                        
                        <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'tbl_materiales_id' => $model->tbl_materiales_id], [
                            'class' => 'action-btn action-btn-edit',
                            'title' => 'Editar',
                        ]) ?>
                        
                        <?= Html::a('<i class="fas fa-trash"></i>', ['delete', 'tbl_materiales_id' => $model->tbl_materiales_id], [
                            'class' => 'action-btn action-btn-delete delete-button',
                            'title' => 'Eliminar',
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