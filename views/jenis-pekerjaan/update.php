<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JenisPekerjaan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Level Pekerjaan',
]) . $model->kode_jenis_pekerjaan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Level Pekerjaan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_jenis_pekerjaan, 'url' => ['view', 'id' => $model->id_jenis_pekerjaan]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="jenis-pekerjaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
