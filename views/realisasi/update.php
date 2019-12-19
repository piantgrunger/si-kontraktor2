<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Realisasi */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Realisasi Pekerjaan ',
]).$model->no_realisasi;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Progress'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_realisasi, 'url' => ['view', 'id' => $model->id_realisasi]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="realisasi-update">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
