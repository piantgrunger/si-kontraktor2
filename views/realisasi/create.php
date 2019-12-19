<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Realisasi */

$this->title = Yii::t('app', 'Realisasi Pekerjaan Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Progress'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realisasi-create">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
