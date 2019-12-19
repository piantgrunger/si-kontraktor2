<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Proyek;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use app\models\Jenisbangunan;

$file_acuan_revisi = explode('.', $model->file_acuan_revisi);

 $form = ActiveForm::begin();

/* @var $this yii\web\View */
/* @var $model app\models\Pekerjaan */
/* @var $form yii\widgets\ActiveForm */

/* @var $this yii\web\View */
/* @var $model app\models\RAB */
/* @var $form yii\widgets\ActiveForm */

/* @var $this yii\web\View */
/* @var $model app\models\Pekerjaan */
/* @var $form yii\widgets\ActiveForm */
$data = ArrayHelper::map(
    Proyek::find()
        ->select([
            'id_Proyek', 'ket' => "[no_Proyek]+'-'+cast(tb_mt_proyek.[keterangan] as varchar(255))+' - '+[nama_customer]",
        ])
        ->innerJoin('tb_m_customer', 'tb_m_customer.id_customer=tb_mt_proyek.id_customer')
        ->asArray()
        ->all(),
    'id_Proyek',
    'ket'
        );
$data2 = ArrayHelper::map(
   Jenisbangunan ::find()
        ->select([
            'id_jenis_bangunan', 'ket' => "[kode_jenis_bangunan]+'-'+[nama_jenis_bangunan]",
        ])

        ->asArray()
        ->all(),
    'id_jenis_bangunan',
    'ket'
        );
/* @var $this yii\web\View */
/* @var $model app\models\RAB */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rab-form">
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->

<?php
if ($this->context->action->id == 'revisi') {
    echo   $form->field($model, 'tgl_revisi')->widget(DateControl::className());

    echo $form->field($model, 'file_acuan_revisi')->widget(FileInput::classname(), [
    'options' => ['multiple ' => false],
    'pluginOptions' => ['overwriteInitial' => true,
        'showUpload' => false,
        'initialPreview' => [Url::to(['/media\/'.$model->file_acuan_revisi], true)],
        'initialPreviewFileType' => end($file_acuan_revisi) === 'pdf' ? 'pdf' : 'image', // image is the default and can be overridden in config below

    'initialCaption' => $model->file_acuan_revisi,
        'initialPreviewAsData' => true, ], ])->label('Acuan Revisi');
}

?>


    <?= $form->field($model, 'id_proyek')->widget(Select2::className(), [
        'data' => $data,
        'options' => ['placeholder' => 'Pilih Proyek...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>



    <?= $form->field($model, 'id_jenis_bangunan')->widget(Select2::className(), [
        'data' => $data2,
        'options' => ['placeholder' => 'Pilih Jenis Bangunan...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label('Jenis Bangunan'); ?>
<?php
if ($this->context->action->id != 'revisi') {
        echo $form->field($model, 'no_rab')->textInput();
    }
?>
    <?= $form->field($model, 'tgl_rab')->widget(DateControl::className()); ?>

    <?= $form->field($model, 'ppn')->textInput(); ?>


    <?= $form->field($model, 'nilai_kontrak')->textInput(); ?>


<div class="panel panel-primary"   >
<div class="panel-heading"> Data Pekerjaan

</div>
<table class="table">
    <thead>
        <tr>
             <th> Level </th>
            <th>Level Pekerjaan</th>

            <th >Pekerjaan</th>
            <th>Nilai Pagu</th>

            <th>Volume</th>
            <th>Satuan</th>

            <th>Hari Kerja</th>
            <th>Status</th>
            <th>Rekanan</th>


            <th><a id="btn-add2" href="#"><span class="glyphicon glyphicon-plus"></span></a></th>
        </tr>
    </thead>
    <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-grid2',
        'allModels' => $model->detailRab,
        'model' => \app\models\d_RAB::className(),
        'tag' => 'tbody',
        'form' => $form,
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item_pekerjaan',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add2',
        ],
    ]);
    ?>
    </table>

</div>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
