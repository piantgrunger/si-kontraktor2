<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\RAB */

$this->title = $model->no_rab;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar R A B'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rab-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
             <?php if ((Mimin::checkRoute($this->context->id."/update"))){ ?>        <?= Html::a(Yii::t('app', 'Ubah'), ['update', 'id' => $model->id_rab], ['class' => 'btn btn-primary']) ?>
        <?php } ?>

          <?php if ((Mimin::checkRoute($this->context->id . "/index"))) { ?>        <?= Html::a(Yii::t('app', 'Daftar RAB'), ['index'], ['class' => 'btn btn-success']) ?>
        <?php
    } ?>
         </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no_proyek',
            'no_rab',
            'tgl_rab:date',
        ],
    ]) ?>



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
        'itemView' => '_item_pekerjaan_edit',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add2',
        ]
    ]);
    ?>
 </div>
</div>

 <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
       'total_biaya_material',
       'total_biaya_pekerja',
       'total_biaya_peralatan',
       'margin',
       'dana_cadangan',
       'total_rab'

    ],
]) ?>


</div>
