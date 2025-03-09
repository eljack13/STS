<?php

use app\models\TblUsuarios;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TblUsuariosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tbl Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tbl Usuarios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tbl_usuarios_id',
            'tbl_usuarios_nombre',
            'tbl_usuarios_apellido',
            'tbl_usuarios_email:email',
            'tbl_usuarios_password',
            //'tbl_usuarios_recoverpass',
            //'tbl_usuarios_auth_key',
            //'tbl_usuarios_access_token',
            //'tbl_usuarios_telefono',
            //'tbl_usuarios_rol',
            //'tbl_usuarios_created',
            //'tbl_usuarios_createdby',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TblUsuarios $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'tbl_usuarios_id' => $model->tbl_usuarios_id]);
                 }
            ],
        ],
    ]); ?>


</div>
