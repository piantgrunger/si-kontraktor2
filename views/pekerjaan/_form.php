<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\JenisPekerjaan;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Pekerjaan;
/* @var $this yii\web\View */
/* @var $model app\models\Pekerjaan */
/* @var $form yii\widgets\ActiveForm */
$data= ArrayHelper::map(
    JenisPekerjaan::find()
        ->select([
            'id_jenis_pekerjaan', "ket" => "[kode_jenis_pekerjaan]+' - '+[nama_jenis_pekerjaan]"
        ])
        ->asArray()
        ->all(),
    'id_jenis_pekerjaan',
    'ket'
        );
$parent = ArrayHelper::map(
    Pekerjaan::find()
        ->select([
            'id_pekerjaan', "ket" => "[kode_pekerjaan]+' - '+[nama_pekerjaan]"
        ])
        ->asArray()
        ->all(),
    'id_pekerjaan',
    'ket'
);

        ?>

<div class="pekerjaan-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->


 <?= $form->field($model, 'id_parent_pekerjaan')->widget(Select2::className(), [
    'data' => $parent,
    'options' => ['placeholder' => 'Pilih Parent Pekerjaan ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]) ->label('Parent Pekerjaan')?>
    <?= $form->field($model, 'kode_pekerjaan')->textInput() ?>

    <?= $form->field($model, 'nama_pekerjaan')->textInput() ?>


    <?= $form->field($model, 'satuan')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
