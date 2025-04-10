<?php
// views/usuarios/view.php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblUsuarios */

$this->title = $model->tbl_usuarios_nombre . ' ' . $model->tbl_usuarios_apellido;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->tbl_usuarios_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->tbl_usuarios_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estás seguro de que quieres eliminar este usuario?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tbl_usuarios_id',
            'tbl_usuarios_nombre',
            'tbl_usuarios_apellido',
            'tbl_usuarios_email:email',
            'tbl_usuarios_telefono',
            [
                'attribute' => 'tbl_usuarios_rol',
                'value' => function($model) {
                    return $model->tbl_usuarios_rol === 'admin' ? 'Administrador' : 'Usuario Regular';
                }
            ],
            'tbl_usuarios_created',
            'tbl_usuarios_createdby',
        ],
    ]) ?>

</div>