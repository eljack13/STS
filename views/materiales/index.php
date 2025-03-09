<?php

use app\models\TblMateriales;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TblMaterialesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tbl Materiales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-materiales-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tbl Materiales', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tbl_materiales_id',
            'tbl_materiales_nombre',
            'tbl_materiales_descripcion',
            'tbl_materiales_cantidad',
            'tbl_materiales_fechaingreso',
            //'tbl_materiales_created',
            //'tbl_materiales_createdby',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TblMateriales $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'tbl_materiales_id' => $model->tbl_materiales_id]);
                 }
            ],
        ],
    ]); ?>


</div>
