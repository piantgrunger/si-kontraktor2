<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Material */

$this->title = Yii::t('app', 'Material / Peralatan  Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Material / Peralatan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
