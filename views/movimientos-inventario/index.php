<?php

use app\models\TblMovimientosInventario;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tbl Movimientos Inventarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-movimientos-inventario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tbl Movimientos Inventario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'material_id',
            'tipo',
            'entrada_salida_ajuste',
            'cantidad',
            //'fecha',
            //'motivo',
            //'usuario_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TblMovimientosInventario $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
