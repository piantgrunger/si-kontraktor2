<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jenisbangunan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Jenis Bangunan',
]) . $model->kode_jenis_bangunan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Jenis Bangunan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_jenis_bangunan, 'url' => ['view', 'id' => $model->id_jenis_bangunan]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="jenisbangunan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
