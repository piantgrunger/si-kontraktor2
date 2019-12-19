<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Rekanan */

$this->title = $model->id_rekanan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Rekanan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekanan-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode_rekanan',
            'nama_rekanan',
            'alamat_rekanan:ntext',
            'kota',
            'telepon',
            'fax',
            'kontak_person',
            'keterangan:ntext',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
