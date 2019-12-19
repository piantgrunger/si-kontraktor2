<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\RAB */

$this->title = $model->no_rab;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar R A B'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


 Yii::$app->params ['kelompok_material'] = "";

?>
<div class="rab-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no_proyek',
            'no_rab',
            'tgl_rab:date',
        ],
    ]) ?>


<table class="table table-condensed table-striped table-hover table-bordered">
    <thead>
        <tr>

            <th colspan=2>Material/Pekerja/Peralatan</th>


            <th>Harga</th>


        </tr>
    </thead>
    <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-grid3',
        'allModels' => $model->daftar_harga,
        'model' => \app\models\sd_RAB_material::className(),
        'tag' => 'tbody',
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item_pekerjaan_harga',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add2',
        ]
    ]);
    ?>
    </table>

</div>



</div>
