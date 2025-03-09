<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TblUsuarios $model */

$this->title = $model->tbl_usuarios_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'tbl_usuarios_id' => $model->tbl_usuarios_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'tbl_usuarios_id' => $model->tbl_usuarios_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
            'tbl_usuarios_password',
            'tbl_usuarios_recoverpass',
            'tbl_usuarios_auth_key',
            'tbl_usuarios_access_token',
            'tbl_usuarios_telefono',
            'tbl_usuarios_rol',
            'tbl_usuarios_created',
            'tbl_usuarios_createdby',
        ],
    ]) ?>

</div>
