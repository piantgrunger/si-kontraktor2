<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Proyek */

$this->title = $model->no_proyek;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Proyek'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyek-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_customer',
            'no_proyek',
            'tgl_mulai',
            'tgl_selesai',
            'status_proyek',
            'keterangan:ntext',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
