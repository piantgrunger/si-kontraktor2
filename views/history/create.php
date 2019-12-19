<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RAB */

$this->title = Yii::t('app', 'R A B Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar R A B'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
