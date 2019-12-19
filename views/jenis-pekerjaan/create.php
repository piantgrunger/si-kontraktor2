<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JenisPekerjaan */

$this->title = Yii::t('app', 'Level Pekerjaan  Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Level Pekerjaan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-pekerjaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
