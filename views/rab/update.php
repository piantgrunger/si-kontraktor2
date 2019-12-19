<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RAB */

$this->title = Yii::t('app', ' Update {modelClass}: ', [
    'modelClass' => 'R A B',
]) . $model->no_rab;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar R A B'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_rab, 'url' => ['view', 'id' => $model->id_rab]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="rab-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
