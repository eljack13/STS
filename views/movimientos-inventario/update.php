<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblMovimientosInventario $model */

$this->title = 'Update Tbl Movimientos Inventario: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Movimientos Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-movimientos-inventario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
