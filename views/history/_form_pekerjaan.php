<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Proyek;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use yii\bootstrap\Tabs;

$form = ActiveForm::begin();

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

/* @var $this yii\web\View */
/* @var $model app\models\Pekerjaan */
/* @var $form yii\widgets\ActiveForm */

/* @var $this yii\web\View */
/* @var $model app\models\RAB */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rab-form">

        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->
    <h4>No RAB  :  <?=$model->no_rab?></h4>
   <h4> Pekerjaan  :  <?= $model->nama_pekerjaan ?></h4>

<?= Tabs::widget([
    'items' => $item
]);
?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
