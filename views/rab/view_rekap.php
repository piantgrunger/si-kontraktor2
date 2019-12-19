<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;
use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
/* @var $model app\models\RAB */

$this->title = 'Komparasi Pagu '.$model->no_rab;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar R A P'), 'url' => ['rap']];
$this->params['breadcrumbs'][] = $this->title;


 Yii::$app->params ['jenis_pekerjaan'] = "";

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
    <div class="text-bold">Periode : <?= Yii::$app->formatter->asDate($model->periode_awal)?> s/d <?= Yii::$app->formatter->asDate($model->periode_akhir)?>   </div>


<table class="table table-condensed table-striped table-hover table-bordered">
    <thead>
        <tr>

            <th >Pekerjaan</th>

            <th>Volume</th>
            <th>Satuan</th>

            <th>Harga</th>

            <th>RAP</th>
     <th>RAB</th>

        </tr>
    </thead>
    <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-grid2',
        'allModels' => $model->detailRab,
        'model' => \app\models\d_RAB::className(),
        'tag' => 'tbody',
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item_pekerjaan_rekap',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add2',
        ]
    ]);
    ?>
    </table>

</div>
 <?= DetailView::widget([
    'model' => $model,
    'attributes' => [

        'total_dpp:decimal',
        'ppn_rp:decimal',

        'total_rab:decimal',
           'nilai_real:decimal'
    ],
]) ?>


<?php

$xAxis = [];
$dataseries1 = [];
$dataseries2 = [];
foreach ($model->detailRab as $detail) {
    $xAxis[] = $detail->nama_pekerjaan_detail;
    $dataseries1[] = (float)$detail->total_rab;
    $dataseries2[] = (float)$detail->nilai_pagu;
}

echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],



    'options' => [
        'title' => ['text' => 'Data RAP'],
        'xAxis' => [
            'categories' => $xAxis,
        ],
        'yAxis' => [
            'title' => ['text' => 'Total Rp '],
        ],
        'series' => [
            [
                'type' => 'column',
                'name' => 'Total',
                'color' => 'green',
                'data' => $dataseries1,
            ],
            [
                'type' => 'column',
                'name' => 'Pagu',
                'color' => 'red',
                'data' => $dataseries2,
            ],
        ],
    ],
]);
?>

</div>
