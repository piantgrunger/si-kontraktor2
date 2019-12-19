<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Pekerjaan */

$this->title = $model->kode_pekerjaan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Pekerjaan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pekerjaan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_jenis_pekerjaan',
            'kode_pekerjaan',
            'nama_pekerjaan',
            'satuan',
            'keterangan:ntext',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
