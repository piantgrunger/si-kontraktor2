<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RealisasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="realisasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_realisasi') ?>

    <?= $form->field($model, 'id_d_rab') ?>

    <?= $form->field($model, 'no_realisasi') ?>

    <?= $form->field($model, 'tgl_aw_realisasi') ?>

    <?= $form->field($model, 'tgl_ak_realisasi') ?>

    <?php // echo $form->field($model, 'total_biaya_material') ?>

    <?php // echo $form->field($model, 'total_biaya_pekerja') ?>

    <?php // echo $form->field($model, 'total_biaya_peralatan') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
