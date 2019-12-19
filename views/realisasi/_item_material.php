<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Material;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use mdm\widgets\TabularInput;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Material */
/* @var $form yii\widgets\ActiveForm */
?>

<td>
<?= Html::hiddenInput("input-$key-id", '', ['id' => "input-$key-id"]); ?>
<?= Html::hiddenInput("input-$key-ket", '', ['id' => "input-$key-ket"]); ?>


   <?= $form->field($model, "[$key]id_sd_rab")->widget(DepDrop::classname(), [
        'type' => DepDrop::TYPE_SELECT2,
        'data' => [$model->id_sd_rab => is_null($model->sdRab) ? "--" : $model->sdRab->nama_material],
        'options' => ['placeholder' => 'Pilih Material ...'],
        'select2Options' => ['pluginOptions' => ['allowClear' => true],

            'pluginEvents' => [
                "select2:select" => "function(e) {    $('input[name=input-".$key."-id]').val(e.params.data.id);$('input[name=input-".$key."-ket]').val(e.params.data.text);
$.post( '".Url::to(['realisasi/qtyrab'])."?id=' +$(this).val(), function(data) {

                                                  data1 = JSON.parse(data)
                                                  $( '#d_realisasi_material-$key-qty' ).val(data1.qty_rab);

}
);

                }"    ,

                ]

    ],
        'pluginOptions' => [
            'depends' => ['realisasi-id_d_rab'],
            'url' => Url::to(['/realisasi/material']),
            'placeholder' => 'Pilih Material ...',
            'initialize' => true,
            'params' => ["input-$key-id", "input-$key-ket"]

        ],

    ])->label(false) ?></td>

<td>
<?= $form->field($model, "[$key]qty")->textInput([

    'onChange' => ' var total =  parseFloat($(this).val())*parseFloat($("#d_realisasi_material-' . $key . '-harga").val()) ; $("#d_realisasi_material-' . $key . '-sub_total").val(total)   ',

])->label(false) ?>

</td>

<td>
<?= $form->field($model, "[$key]harga")->textInput([

    'onChange' => ' var total =  parseFloat($(this).val())*parseFloat($("#d_realisasi_material-' . $key . '-qty").val()) ; $("#d_realisasi_material-' . $key . '-sub_total").val(total)   ',

])->label(false) ?>

</td>
<td>
<?= $form->field($model, "[$key]sub_total")->textInput()->label(false) ?>

</td>

    <td>
    <a data-action="delete" id='delete1'><span class="glyphicon glyphicon-trash">
</td>