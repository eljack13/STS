<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\TblMateriales;
use app\models\TblMovimientosInventario;

/* @var $this yii\web\View */
/* @var $model app\models\TblMovimientosInventario */
/* @var $materiales array */

$this->title = 'Registrar Movimiento de Inventario';
$this->params['breadcrumbs'][] = ['label' => 'Movimientos Inventario', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-movimientos-inventario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tbl_materiales_id')->dropDownList(
        ArrayHelper::map($materiales, 'tbl_materiales_id', function($material) {
            return $material->tbl_materiales_nombre . ' (' . $material->tbl_materiales_codigo . ') - Stock: ' . $material->tbl_materiales_cantidad;
        }),
        ['prompt' => 'Seleccione un material']
    ) ?>

    <?= $form->field($model, 'tipo')->dropDownList([
        TblMateriales::TIPO_ENTRADA => 'Entrada',
        TblMateriales::TIPO_SALIDA => 'Salida',
        TblMateriales::TIPO_AJUSTE => 'Ajuste'
    ], ['prompt' => 'Seleccione el tipo']) ?>

    <?= $form->field($model, 'entrada_salida_ajuste')->textInput(['type' => 'number', 'step' => '0.01']) ?>

    <?= $form->field($model, 'motivo')->textarea(['rows' => 3]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>