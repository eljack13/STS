<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblMateriales $model */

$this->title = 'Update Tbl Materiales: ' . $model->tbl_materiales_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tbl_materiales_id, 'url' => ['view', 'tbl_materiales_id' => $model->tbl_materiales_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-materiales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
