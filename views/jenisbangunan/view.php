<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Jenisbangunan */

$this->title = $model->kode_jenis_bangunan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Jenis Bangunan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenisbangunan-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode_jenis_bangunan',
            'nama_jenis_bangunan',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
