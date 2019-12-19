<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\LevelJabatan;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use mdm\widgets\TabularInput;

use yii\helpers\Url;

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
/* @var $model app\models\rab */
/* @var $form yii\widgets\ActiveForm */
?>
<td>

    <?= $form->field($model, "[$key]id_level_jabatan")->widget(Select2::className(), [
        'data' => $data,
        'options' => ['placeholder' => 'Pilih Level Jabatan...',
            'onChange' => "$.post( '" . Url::to(['rab/upah-pekerja']) . "?id=' +$(this).val(), function(data) {

                                                  data1 = JSON.parse(data)
                                                  $( '#sd_rab_pekerja-$key-gaji' ).val(data1.upah);

            })
"
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(false) ?>
</td>
<td>
<?= $form->field($model, "[$key]qty")->textInput([

    'onChange' => ' var total =  parseFloat($(this).val())*parseFloat($("#sd_rab_pekerja-' . $key . '-gaji").val()) ; $("#sd_rab_pekerja-' . $key . '-sub_total").val(total)   ',

])->label(false) ?>

</td>

<td>
<?= $form->field($model, "[$key]gaji")->textInput([

    'onChange' => ' var total =  parseFloat($(this).val())*parseFloat($("#sd_rab_pekerja-' . $key . '-qty").val()) ; $("#sd_rab_pekerja-' . $key . '-sub_total").val(total)   ',

])->label(false) ?>

</td>


<td>
<?= $form->field($model, "[$key]satuan")->textInput()->label(false) ?>

</td>
<td>
<?= $form->field($model, "[$key]sub_total")->textInput(['readOnly' => true])->label(false)  ?>

</td>

    <td>
<?= $form->field($model, "[$key]id_sd_rab")->hiddenInput()->label(false); ?>

    <a data-action="delete" id='delete2'><span class="glyphicon glyphicon-trash">
</td>
