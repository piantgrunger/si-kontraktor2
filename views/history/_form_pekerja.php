<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\LevelJabatan;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use mdm\widgets\TabularInput;

/* @var $this yii\web\View */
/* @var $model app\models\Pekerjaan */
/* @var $form yii\widgets\ActiveForm */

/* @var $this yii\web\View */
/* @var $model app\models\RAB */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rab-form">

<div class="panel panel-primary"   >
<div class="panel-heading"> Data Peralatan

</div>
<table class="table table-condensed table-striped table-hover table-bordered">
    <thead>
        <tr>

            <th>Level Jabatan</th>
            <th>Qty</th>
           <th>Gaji</th>
           <th>Sub Total</th>

            <th><a id="btn-add4" href="#"><span class="glyphicon glyphicon-plus"></span></a></th>
        </tr>
    </thead>
    <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-grid4',
        'allModels' => $model->sDetailRabPekerja,
        'model' => \app\models\sd_RAB_Pekerja::className(),
        'tag' => 'tbody',
        'form' => $form,
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item_Pekerja',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add4',
        ]
    ]);
    ?>
    </table>
</div>
</div>