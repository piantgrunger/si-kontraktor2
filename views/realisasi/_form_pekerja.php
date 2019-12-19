<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Proyek;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use mdm\widgets\TabularInput;
?>

<div class="rab-form">

<div class="panel panel-primary"   >
<div class="panel-heading"> Data Pekerja

</div>


<table class="table table-condensed table-striped table-hover table-bordered">
    <thead>
        <tr>

            <th>Jenis Jabatan</th>

            <th>Karyawan</th>
           <th>Gaji</th>
           <th>Sub Total</th>

            <th><a id="btn-add4" href="#"><span class="glyphicon glyphicon-plus"></span></a></th>
        </tr>
    </thead>
    <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-grid4',
        'allModels' => $model->det_realisasi_pekerja,
        'model' => \app\models\d_realisasi_pekerja::className(),
        'tag' => 'tbody',
        'form' => $form,
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item_pekerja',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add4',
        ]
    ]);
    ?>
    </table>
</div>

</div>