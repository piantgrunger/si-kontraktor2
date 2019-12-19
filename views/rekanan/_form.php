<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Rekanan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rekanan-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'kode_rekanan')->textInput() ?>

    <?= $form->field($model, 'nama_rekanan')->textInput() ?>

    <?= $form->field($model, 'alamat_rekanan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'kota')->textInput() ?>

    <?= $form->field($model, 'telepon')->textInput() ?>

    <?= $form->field($model, 'fax')->textInput() ?>

    <?= $form->field($model, 'kontak_person')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
