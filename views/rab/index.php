
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

    [
        'class' => 'kartik\grid\ActionColumn', 'template' => '{view}  {rekap} {jenis} {harga}  {revisi} {delete} ',
        'buttons' => [
            'revisi' => function ($url, $model) {
                if (Mimin::checkRoute($this->context->id.'/revisi')) {
                    return
                        Html::a(
                        '<span class="glyphicon glyphicon-ok"></span>',
                        ['revisi', 'id' => $model->id_rab],
                        [
                            'title' => Yii::t('app', 'Revisi'),
                        ]
                    );
                } else {
                    return ' ';
                }
            }, 'delete' => function ($url, $model) {
                if (Mimin::checkRoute($this->context->id.'/delete')) {
                    return
                        Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>',
                        ['delete', 'id' => $model->id_rab],
                        [
                            'title' => Yii::t('app', 'Hapus'),
                            'data' => [
                                'confirm' => Yii::t('app', 'Apakah Anda yakin ingin menghapus item ini??'),
                                'method' => 'post',
                            ],
                        ]
                    );
                } else {
                    return ' ';
                }
            }, 'rekap' => function ($url, $model) {
                if (Mimin::checkRoute($this->context->id.'/view-rekap')) {
                    return
                        Html::a(
                        '<span class="glyphicon glyphicon-list"></span>',
                        ['view-rekap', 'id' => $model->id_rab],
                        [
                            'title' => Yii::t('app', 'Rekap'),
                            'data-pjax' => 0,
                        ]
                    );
                } else {
                    return ' ';
                }
            },
            'jenis' => function ($url, $model) {
                if (Mimin::checkRoute($this->context->id.'/view-jenis-pekerjaan')) {
                    return
                        Html::a(
                        '<span class="glyphicon glyphicon-list"></span>',
                        ['jenis-pekerjaan', 'id' => $model->id_rab],
                        [
                            'title' => Yii::t('app', 'Rekap Jenis Pekerjaan'),
                            'data-pjax' => 0,
                        ]
                    );
                } else {
                    return ' ';
                }
            }, 'view' => function ($url, $model) {
                if (Mimin::checkRoute($this->context->id.'/view')) {
                    return
                        Html::a(
                        '<span class="glyphicon glyphicon-list"></span>',
                        ['view', 'id' => $model->id_rab],
                        [
                            'title' => Yii::t('app', 'Lihat BQ'),
                            'data-pjax' => 0,
                        ]
                    );
                } else {
                    return ' ';
                }
            }, 'harga' => function ($url, $model) {
                if (Mimin::checkRoute($this->context->id.'/view-harga')) {
                    return
                        Html::a(
                        '<span class="glyphicon glyphicon-list"></span>',
                        ['view-harga', 'id' => $model->id_rab],
                        [
                            'title' => Yii::t('app', 'Lihat Daftar Harga'),
                            'data-pjax' => 0,
                        ]
                    );
                } else {
                    return ' ';
                }
            },
        ],
    ],     ];

/* @var $this yii\web\View */
/* @var $searchModel app\models\RABSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar R A B');
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
           'heading' => '<i class="glyphicon glyphicon-tasks"></i>  <strong> '.Yii::t('app', 'R A B').'</strong>',
            'before' => $this->render('_search', ['model' => $searchModel]),
        ],
            'toolbar' => [
        ['content' => ((Mimin::checkRoute($this->context->id.'/create'))) ? Html::a(Yii::t('app', 'R A B Baru'), ['create'], ['class' => 'btn btn-success']) : ''],
        Html::a(Yii::t('app', 'Laporan per Periode'), ['report', 'tgl_aw' => $searchModel->tgl_aw, 'tgl_ak' => $searchModel->tgl_ak], ['class' => 'btn btn-primary', 'id' => 'report',   'data-pjax' => 0]),
        '{export}',
        '{toggleData}',
    ],

    'exportConfig' => [GridView::CSV => ['filename' => $this->title],         GridView::HTML => ['filename' => $this->title],         GridView::PDF => ['filename' => $this->title],         GridView::EXCEL => ['filename' => $this->title, 'options' => ['title' => $this->title]],         GridView::TEXT => ['filename' => $this->title]],     'resizableColumns' => true,
    ]); ?>
    <?php Pjax::end(); ?>
</div>
