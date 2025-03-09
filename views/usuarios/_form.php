<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblUsuarios $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbl-usuarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tbl_usuarios_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tbl_usuarios_apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tbl_usuarios_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tbl_usuarios_password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tbl_usuarios_recoverpass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tbl_usuarios_auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tbl_usuarios_access_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tbl_usuarios_telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tbl_usuarios_rol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tbl_usuarios_created')->textInput() ?>

    <?= $form->field($model, 'tbl_usuarios_createdby')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
