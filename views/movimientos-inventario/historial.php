<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $material app\models\TblMateriales */
/* @var $movimientos array */

$this->title = 'Historial de Movimientos: ' . $material->tbl_materiales_nombre;
$this->params['breadcrumbs'][] = ['label' => 'Movimientos Inventario', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movimientos-inventario-historial">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3>Stock actual: <?= $material->tbl_materiales_cantidad ?></h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Stock después</th>
                <th>Motivo</th>
                <th>Usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movimientos as $movimiento): ?>
            <tr>
                <td><?= Yii::$app->formatter->asDatetime($movimiento->fecha) ?></td>
                <td>
                    <?php 
                    $tipoLabels = [
                        TblMateriales::TIPO_ENTRADA => '<span class="label label-success">Entrada</span>',
                        TblMateriales::TIPO_SALIDA => '<span class="label label-danger">Salida</span>',
                        TblMateriales::TIPO_AJUSTE => '<span class="label label-warning">Ajuste</span>'
                    ];
                    echo $tipoLabels[$movimiento->tipo] ?? $movimiento->tipo;
                    ?>
                </td>
                <td><?= $movimiento->entrada_salida_ajuste ?></td>
                <td><?= $movimiento->cantidad ?></td>
                <td><?= Html::encode($movimiento->motivo) ?></td>
                <td><?= Html::encode($movimiento->usuario->username ?? 'N/A') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>