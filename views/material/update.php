<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Material */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Material / Peralatan',
]) . $model->kode_material;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Material / Peralatan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_material, 'url' => ['view', 'id' => $model->id_material]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="material-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
