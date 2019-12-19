<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RAB */

$this->title = Yii::t('app', 'Detail Pekerjaan ') ;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar R A B'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_rab, 'url' => ['view', 'id' => $model->id_rab]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Detail Pekerjaan');
?>
<div class="rab-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_pekerjaan', [
        'model' => $model,
    ]) ?>

</div>
