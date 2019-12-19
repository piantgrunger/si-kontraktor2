<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;


/* @var $this yii\web\View */
/* @var $model app\models\RABSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rab-search">

      <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',

        ]); ?>
 <div class="row">
        <div class="col-sm-4">   <?= $form->field($model, 'tgl_aw')->widget(DateControl::classname()) ?></div>

    <div class="col-sm-4">   <?= $form->field($model, 'tgl_ak')->widget(DateControl::classname()) ?></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
