<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pekerjaan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pekerjaan',
]) . $model->kode_pekerjaan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Pekerjaan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_pekerjaan, 'url' => ['view', 'id' => $model->id_pekerjaan]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pekerjaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
