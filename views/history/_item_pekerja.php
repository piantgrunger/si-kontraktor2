<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\LevelJabatan;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use mdm\widgets\TabularInput;

/* @var $this yii\web\View */
/* @var $model app\models\LevelJabatan */
/* @var $form yii\widgets\ActiveForm */
$data = ArrayHelper::map(
    LevelJabatan::find()
        ->select([
            'id_Level_Jabatan', "ket" => "[kode_Level_Jabatan]+' - '+[nama_Level_Jabatan]"
        ])

        ->asArray()
        ->all(),
    'id_Level_Jabatan',
    'ket'
        );

/* @var $this yii\web\View */
/* @var $model app\models\RAB */
/* @var $form yii\widgets\ActiveForm */
?>

<td>
    <?= $form->field($model, "[$key]id_level_jabatan")->widget(Select2::className(), [
        'data' => $data,
        'options' => ['placeholder' => 'Pilih Level Jabatan...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(false) ?>
</td>
<td>
<?= $form->field($model, "[$key]qty")->textInput([

    'onKeyUp' => ' var total =  parseFloat($(this).val())*parseFloat($("#sd_RAB_pekerja-' . $key . '-gaji").val()) ; $("#sd_RAB_pekerja-' . $key . '-sub_total").val(total)   ',

])->label(false) ?>

</td>

<td>
<?= $form->field($model, "[$key]gaji")->textInput([

    'onKeyUp' => ' var total =  parseFloat($(this).val())*parseFloat($("#sd_RAB_pekerja-' . $key . '-qty").val()) ; $("#sd_RAB_pekerja-' . $key . '-sub_total").val(total)   ',

])->label(false) ?>

</td>
<td>
<?= $form->field($model, "[$key]sub_total")->textInput()->label(false)  ?>

</td>

    <td>
    <a data-action="delete" id='delete1'><span class="glyphicon glyphicon-trash">
</td>