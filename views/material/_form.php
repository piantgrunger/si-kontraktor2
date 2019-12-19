<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Material */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'kode_material')->textInput() ?>

    <?= $form->field($model, 'nama_material')->textInput() ?>
    <?= $form->field($model, 'jenis')->dropDownList(["Material"=>"Material","Peralatan"=>"Peralatan"], ['prompt' => 'Pilih Jenis...']) ?>
    <?= $form->field($model, 'kelompok_material')->dropDownList(["Agregat Kasar,Bahan Perkerasan dan Bahan Jadi" => "Agregat Kasar,Bahan Perkerasan dan Bahan Jadi",
     "Bahan Kayu Berikut Bahan Jadinya" => "Bahan Kayu Berikut Bahan Jadinya",
     'Bahan Finishing' => 'Bahan Finishing',
     "Barang Logam dll" => "Barang Logam dll"
], ['prompt' => 'Pilih Kategori...']) ?>

    <?= $form->field($model, 'satuan')->textInput() ?>

    <?= $form->field($model, 'harga')->textInput() ?>
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
