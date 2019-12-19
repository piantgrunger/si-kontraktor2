<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Peralatan;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use mdm\widgets\TabularInput;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Peralatan */
/* @var $form yii\widgets\ActiveForm */
?>

<td>
<?= Html::hiddenInput("input1-$key-id", '', ['id' => "input1-$key-id"]); ?>
<?= Html::hiddenInput("input1-$key-ket", '', ['id' => "input1-$key-ket"]); ?>


   <?= $form->field($model, "[$key]id_sd_rab")->widget(DepDrop::classname(), [
        'type' => DepDrop::TYPE_SELECT2,
        'data' => [$model->id_sd_rab => is_null($model->sdRab) ? "--" : $model->sdRab->nama_material],
        'options' => ['placeholder' => 'Pilih Peralatan ...'],
        'select2Options' => ['pluginOptions' => ['allowClear' => true],

            'pluginEvents' => [
                "select2:select" => "function(e) {    $('input[name=input1-".$key."-id]').val(e.params.data.id);$('input[name=input1-".$key."-ket]').val(e.params.data.text);
$.post( '".Url::to(['realisasi/qtyrabperalatan'])."?id=' +$(this).val(), function(data) {

                                                  data1 = JSON.parse(data)
                                                  $( '#d_realisasi_peralatan-$key-qty' ).val(data1.qty_rab);

}
);

                }"    ,

                ]

    ],
        'pluginOptions' => [
            'depends' => ['realisasi-id_d_rab'],
            'url' => Url::to(['/realisasi/peralatan']),
            'placeholder' => 'Pilih Peralatan ...',
            'initialize' => true,
            'params' => ["input1-$key-id", "input1-$key-ket"]

        ],

    ])->label(false) ?></td>

<td>
<?= $form->field($model, "[$key]qty")->textInput([

    'onChange' => ' var total =  parseFloat($(this).val())*parseFloat($("#d_realisasi_peralatan-' . $key . '-harga").val()) ; $("#d_realisasi_peralatan-' . $key . '-sub_total").val(total)   ',

])->label(false) ?>

</td>

<td>
<?= $form->field($model, "[$key]harga")->textInput([

    'onChange' => ' var total =  parseFloat($(this).val())*parseFloat($("#d_realisasi_peralatan-' . $key . '-qty").val()) ; $("#d_realisasi_peralatan-' . $key . '-sub_total").val(total)   ',

])->label(false) ?>

</td>
<td>
<?= $form->field($model, "[$key]sub_total")->textInput()->label(false) ?>

</td>

    <td>
    <a data-action="delete" id='delete1'><span class="glyphicon glyphicon-trash">
</td>