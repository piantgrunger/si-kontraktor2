<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$gridColumns = [['class' => 'kartik\grid\SerialColumn'],
            'no_realisasi',
            'tgl_aw_realisasi',
            'tgl_ak_realisasi',
            'no_rab',
            'nama_pekerjaan',
            'qty',

             'total_biaya_material',
             'total_biaya_pekerja',
             'total_biaya_peralatan',
            // 'keterangan:ntext',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

         ['class' => 'kartik\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'update', 'delete', 'view', ], $this->context->route)],    ];

/* @var $this yii\web\View */
/* @var $searchModel app\models\RealisasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Realisasi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Realisasi-index">

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
           'heading' => '<i class="glyphicon glyphicon-tasks"></i>  <strong> '.Yii::t('app', 'Progress').'</strong>',
        ],
            'toolbar' => [
        ['content' => ((Mimin::checkRoute($this->context->id.'/create'))) ? Html::a(Yii::t('app', 'Progress Baru'), ['create'], ['class' => 'btn btn-success']) : ''],

        '{export}',
        '{toggleData}',
    ],

    'exportConfig' => [         GridView::CSV => ['filename' => $this->title],         GridView::HTML => ['filename' => $this->title],         GridView::PDF => ['filename' => $this->title],         GridView::EXCEL => ['filename' => $this->title, 'options' => ['title' => $this->title], ],         GridView::TEXT => ['filename' => $this->title],     ],     'resizableColumns' => true,
    ]); ?>
    <?php Pjax::end(); ?>
</div>
