<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proyek */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Proyek',
]) . $model->no_proyek;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Proyek'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_proyek, 'url' => ['view', 'id' => $model->id_proyek]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="proyek-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
