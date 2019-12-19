<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Pekerjaan;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use mdm\widgets\TabularInput;

/* @var $this yii\web\View */
/* @var $model app\models\Pekerjaan */
/* @var $form yii\widgets\ActiveForm */
$data = ArrayHelper::map(
    Pekerjaan::find()
        ->select([
            'id_Pekerjaan', "ket" => "[kode_Pekerjaan]+' - '+[nama_pekerjaan]"
        ])
        ->asArray()
        ->all(),
    'id_Pekerjaan',
    'ket'
        );
/* @var $this yii\web\View */
/* @var $model app\models\RAB */
/* @var $form yii\widgets\ActiveForm */
?>

<td>
<?= $form->field($model, "[$key]id_d_rab")->hiddenInput()->label(false); ?>

    <?= $form->field($model,"[$key]id_pekerjaan")->widget(Select2::className(), [
        'data' => $data,
        'options' => ['placeholder' => 'Pilih Pekerjaan...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(false) ?>
</td>
<td>

</td>
  <td>
    <a data-action="delete"><span class="glyphicon glyphicon-trash">
</td>