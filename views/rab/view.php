<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RAB */

$this->title = 'R A B';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar R A B'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rab-view">

    <h1><?= Html::encode($this->title); ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no_proyek',
            'no_rab',
            'tgl_rab:date',
        ],
    ]); ?>



<div class="panel panel-primary"   >
<div class="panel-heading"> Data Pekerjaan

</div>
<div class="detail">

   <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-grid2',
        'allModels' => $model->detailRab,
        'model' => \app\models\d_RAB::className(),
        'tag' => 'div',
        'form' => null,
        'itemOptions' => ['tag' => 'div'],
        'itemView' => '_item_pekerjaan_view',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add2',
        ],
    ]);
    ?>
 </div>
</div>

 <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'total_dpp:decimal',
        'ppn_rp:decimal',

        'total_rab:decimal',
        'retensi:decimal',
    ],
]); ?>


</div>
