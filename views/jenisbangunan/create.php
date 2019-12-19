<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Jenisbangunan */

$this->title = Yii::t('app', 'Jenis Bangunan Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Jenis Bangunan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenisbangunan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
