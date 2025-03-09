<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblMaterialesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbl-materiales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tbl_materiales_id') ?>

    <?= $form->field($model, 'tbl_materiales_nombre') ?>

    <?= $form->field($model, 'tbl_materiales_descripcion') ?>

    <?= $form->field($model, 'tbl_materiales_cantidad') ?>

    <?= $form->field($model, 'tbl_materiales_fechaingreso') ?>

    <?php // echo $form->field($model, 'tbl_materiales_created') ?>

    <?php // echo $form->field($model, 'tbl_materiales_createdby') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
