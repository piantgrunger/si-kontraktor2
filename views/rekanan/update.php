<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rekanan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Rekanan',
]) . $model->id_rekanan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Rekanan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_rekanan, 'url' => ['view', 'id' => $model->id_rekanan]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="rekanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
