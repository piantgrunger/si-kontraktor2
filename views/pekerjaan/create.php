<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pekerjaan */

$this->title = Yii::t('app', 'Pekerjaan  Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Pekerjaan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pekerjaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
