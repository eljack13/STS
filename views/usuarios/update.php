<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblUsuarios $model */

$this->title = 'Update Tbl Usuarios: ' . $model->tbl_usuarios_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tbl_usuarios_id, 'url' => ['view', 'tbl_usuarios_id' => $model->tbl_usuarios_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-usuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
