<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TblMateriales $model */

$this->title = $model->tbl_materiales_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-materiales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'tbl_materiales_id' => $model->tbl_materiales_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'tbl_materiales_id' => $model->tbl_materiales_id], [
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
            'tbl_materiales_id',
            'tbl_materiales_nombre',
            'tbl_materiales_descripcion',
            'tbl_materiales_cantidad',
            'tbl_materiales_fechaingreso',
            'tbl_materiales_created',
            'tbl_materiales_createdby',
        ],
    ]) ?>

</div>
