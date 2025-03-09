<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblUsuariosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbl-usuarios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tbl_usuarios_id') ?>

    <?= $form->field($model, 'tbl_usuarios_nombre') ?>

    <?= $form->field($model, 'tbl_usuarios_apellido') ?>

    <?= $form->field($model, 'tbl_usuarios_email') ?>

    <?= $form->field($model, 'tbl_usuarios_password') ?>

    <?php // echo $form->field($model, 'tbl_usuarios_recoverpass') ?>

    <?php // echo $form->field($model, 'tbl_usuarios_auth_key') ?>

    <?php // echo $form->field($model, 'tbl_usuarios_access_token') ?>

    <?php // echo $form->field($model, 'tbl_usuarios_telefono') ?>

    <?php // echo $form->field($model, 'tbl_usuarios_rol') ?>

    <?php // echo $form->field($model, 'tbl_usuarios_created') ?>

    <?php // echo $form->field($model, 'tbl_usuarios_createdby') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
