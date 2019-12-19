<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\RAB;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use yii\bootstrap\Tabs;




/* @var $this yii\web\View */
/* @var $model app\models\Realisasi */
/* @var $form yii\widgets\ActiveForm */
$data = ArrayHelper::map(
    RAB::find()
        ->select([
            'id_RAB', "ket" => "[no_RAB]+' - '+[nama_customer]"
        ])
        ->innerJoin('tb_mt_proyek', 'tb_mt_proyek.id_proyek=tb_mt_RAB.id_proyek')
        ->innerJoin('tb_m_customer', 'tb_m_customer.id_customer=tb_mt_proyek.id_customer')
        ->asArray()
        ->all(),
    'id_RAB',
    'ket'
);

  $form = ActiveForm::begin ();

$item =
    [
    [
        'label' => 'Data Material',
        'content' => $this->render('_form_material', ['model' => $model, 'form' => $form]),
        'active' => true,
    ],

    [
        'label' => 'Data Peralatan',
        'content' => $this->render('_form_peralatan', ['model' => $model, 'form' => $form]),
    ],

    [
        'label' => 'Data Pekerja',
        'content' => $this->render('_form_pekerja', ['model' => $model, 'form' => $form]),
    ],



];



?>

<div class="realisasi-form">

        <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'id_rab')->widget(Select2::className(), [
        'data' => $data,
        'options' => ['placeholder' => 'Pilih RAB...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>


   <?= $form->field($model, "id_d_rab")->widget(DepDrop::classname(), [
        'type' => DepDrop::TYPE_SELECT2,
        'data' => [$model->id_d_rab => is_null($model->dRab) ? "--" : $model->dRab->nama_pekerjaan ],
        'options' => ['placeholder' => 'Pilih Pekerjaan ...'],
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'depends' => ['realisasi-id_rab'],
            'url' => Url::to(['/realisasi/pekerjaan']),
            'placeholder' => 'Pilih Pekerjaan ...',
            'initialize' => true,

        ]
    ]) ?>

    <?= $form->field($model, 'no_realisasi')->textInput() ?>

    <?= $form->field($model, 'tgl_aw_realisasi')->widget(DateControl::className())?>

    <?= $form->field($model, 'tgl_ak_realisasi')->widget(DateControl::className()) ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= Tabs::widget([
        'items' => $item
    ]);
    ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
