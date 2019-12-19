<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\LevelJabatan;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
/* @var $this yii\web\View */
/* @var $model app\models\Pekerjaan */
/* @var $form yii\widgets\ActiveForm */
$data = ArrayHelper::map(
    LevelJabatan::find()
        ->select([
            'id_level_jabatan', "ket" => "[kode_level_jabatan]+' - '+[nama_level_jabatan]"
        ])
        ->asArray()
        ->all(),
    'id_level_jabatan',
    'ket'
);

/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="karyawan-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'id_level_jabatan')->widget(Select2::className(), [
        'data' => $data,
        'options' => ['placeholder' => 'Pilih Level Jabatan\ ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'kode_karyawan')->textInput() ?>

    <?= $form->field($model, 'nama_karyawan')->textInput() ?>

    <?= $form->field($model, 'alamat_karyawan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput() ?>

    <?= $form->field($model, 'tanggal_lahir')->widget(DateControl::classname()) ?>

    <?= $form->field($model, 'status_karyawan')->dropDownList(["Tetap" => "Tetap", "Borongan" => "Borongan"]) ?>


    <?= $form->field($model, 'telepon')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
