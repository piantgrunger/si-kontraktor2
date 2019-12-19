<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Customer;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
/* @var $this yii\web\View */
/* @var $model app\models\Pekerjaan */
/* @var $form yii\widgets\ActiveForm */
$data = ArrayHelper::map(
    Customer::find()
        ->select([
            'id_Customer', "ket" => "[kode_Customer]+' - '+[nama_Customer]"
        ])
        ->asArray()
        ->all(),
    'id_Customer',
    'ket'
);

/* @var $this yii\web\View */
/* @var $model app\models\Proyek */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyek-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'id_customer')->widget(Select2::className(), [
        'data' => $data,
        'options' => ['placeholder' => 'Pilih Customer...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'no_proyek')->textInput() ?>

    <?= $form->field($model, 'tgl_mulai')->widget(DateControl::classname()) ?>

    <?= $form->field($model, 'tgl_selesai')->widget(DateControl::classname()) ?>

    <?= $form->field($model, 'status_proyek')->dropDownList(["Survey"=>"Survey",
        "Kontrak" => "Kontrak",
        "Progress" => "Progress",
        "Selesai" => "Selesai",
        "Suspend" => "Suspend",
        "Batal" => "Batal",
    ]) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
