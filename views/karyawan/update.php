<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Karyawan',
]) . $model->kode_karyawan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Karyawan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_karyawan, 'url' => ['view', 'id' => $model->id_karyawan]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="karyawan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
