<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Material;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use mdm\widgets\TabularInput;

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Material */
/* @var $form yii\widgets\ActiveForm */
$data = ArrayHelper::map(
    Material::find()
        ->select([
            'id_Material', "ket" => "[kode_Material]+' - '+[nama_Material]"
        ])
        ->where("jenis='Peralatan'")
        ->asArray()
        ->all(),
    'id_Material',
    'ket'
        );

/* @var $this yii\web\View */
/* @var $model app\models\rab */
/* @var $form yii\widgets\ActiveForm */
?>
<td>

    <?= $form->field($model, "[$key]id_material")->widget(Select2::className(), [
        'data' => $data,
        'options' => ['placeholder' => 'Pilih Peralatan...',
            'onChange' => "$.post( '" . Url::to(['rab/satuan-material']) . "?id=' +$(this).val(), function(data) {

                                                  data1 = JSON.parse(data)
                                                  $( '#sd_rab_peralatan-$key-satuan' ).val(data1.satuan);
                                                          $( '#sd_rab_peralatan-$key-harga' ).val(data1.harga);

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

    'onChange' => ' var total =  parseFloat($(this).val())*parseFloat($("#sd_rab_peralatan-' . $key . '-harga").val()) ; $("#sd_rab_peralatan-' . $key . '-sub_total").val(total)   ',

])->label(false) ?>

</td>

<td>
<?= $form->field($model, "[$key]harga")->textInput([

    'onChange' => ' var total =  parseFloat($(this).val())*parseFloat($("#sd_rab_peralatan-' . $key . '-qty").val()) ; $("#sd_rab_peralatan-' . $key . '-sub_total").val(total)   ',

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

    <a data-action="delete" id='delete3'><span class="glyphicon glyphicon-trash">
</td>