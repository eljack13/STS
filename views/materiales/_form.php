<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblMateriales $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbl-materiales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tbl_materiales_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tbl_materiales_descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tbl_materiales_cantidad')->textInput() ?>

    <?= $form->field($model, 'tbl_materiales_fechaingreso')->textInput() ?>

    <?= $form->field($model, 'tbl_materiales_created')->textInput() ?>

    <?= $form->field($model, 'tbl_materiales_createdby')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
