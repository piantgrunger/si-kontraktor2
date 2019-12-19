<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Customer',
]) . $model->kode_customer;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Customer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_customer, 'url' => ['view', 'id' => $model->id_customer]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="customer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
