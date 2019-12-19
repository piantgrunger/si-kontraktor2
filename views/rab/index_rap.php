
<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$gridColumns = [['class' => 'kartik\grid\SerialColumn'],
            'no_proyek',
            'no_rab',
            'tgl_rab:date',
    'nama_jenis_bangunan',
    'nilai_kontrak:decimal',
    'nilai_real:decimal',
            // 'margin',
            // 'dana_cadangan',
    'total_rab:decimal',
            // 'keterangan:ntext',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

         ['class' => 'kartik\grid\ActionColumn',   'template' => '{rekap} {revisi} ',
        'buttons' => ['revisi' => function ($url, $model) {
            if (Mimin::checkRoute($this->context->id.'/revisi')) {
                return
                    Html::a(
                '<span class="glyphicon glyphicon-ok"></span>',
                ['detail-rap', 'id' => $model->id_rab],
                [
                    'title' => Yii::t('app', 'Input RAP'),
                        'data-pjax' => 0
                ]
            );
            } else {
                return ' ';
            }
        }, 'rekap' => function ($url, $model) {
            if (Mimin::checkRoute($this->context->id.'/komparasi')) {
                return
                    Html::a(
                    '<span class="glyphicon glyphicon-list"></span>',
                    ['komparasi', 'id' => $model->id_rab],
                    [
                        'title' => Yii::t('app', 'Komparasi Pagu'),
                         'data-pjax' => 0

                        ]
                );
            } else {
                return ' ';
            }
        }, ],    ],    ];

/* @var $this yii\web\View */
/* @var $searchModel app\models\RABSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar R A P');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rab-index">

    <h1><?= Html::encode($this->title); ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'tableOptions' => ['class' => 'table  table-bordered table-hover'],
        'striped' => false,
        'containerOptions' => [true],
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,

        'showPageSummary' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
           'heading' => '<i class="glyphicon glyphicon-tasks"></i>  <strong> '.Yii::t('app', 'R A P').'</strong>',
            'before' => $this->render('_search', ['model' => $searchModel]),
        ],
            'toolbar' => [
        '{export}',
        '{toggleData}',
    ],

    'exportConfig' => [         GridView::CSV => ['filename' => $this->title],         GridView::HTML => ['filename' => $this->title],         GridView::PDF => ['filename' => $this->title],         GridView::EXCEL => ['filename' => $this->title, 'options' => ['title' => $this->title], ],         GridView::TEXT => ['filename' => $this->title],     ],     'resizableColumns' => true,
    ]); ?>
    <?php Pjax::end(); ?>
</div>
