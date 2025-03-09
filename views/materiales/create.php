<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblMateriales $model */

$this->title = 'Create Tbl Materiales';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-materiales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
