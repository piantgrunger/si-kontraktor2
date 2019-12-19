<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$gridColumns=[['class' => 'kartik\grid\SerialColumn'],
            'jenis',
            'kode_material',
            'nama_material',
         //   'spesifikasi',
            'satuan',
            'harga',
            // 'keterangan:ntext',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

         ['class' => 'kartik\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'update','delete','view'], $this->context->route),    ],    ];


/* @var $this yii\web\View */
/* @var $searchModel app\models\MaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Material / Peralatan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-index">

    <h1><?= Html::encode($this->title) ?></h1>
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
    'condensed' => true,
    'responsive' => true,
    'hover' => true,

    'showPageSummary' => false,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => '<i class="glyphicon glyphicon-tasks"></i>  <strong> Material / Peralatan </strong>',


    ],
    'toolbar' => [
        ['content' => ((Mimin::checkRoute($this->context->id . "/create"))) ? Html::a(Yii::t('app', 'Material / Peralatan Baru'), ['create'], ['class' => 'btn btn-success']) : ""],
        '{export}',
        '{toggleData}'
    ],

    'resizableColumns' => true,
    ]); ?>
    <?php Pjax::end(); ?>
</div>
