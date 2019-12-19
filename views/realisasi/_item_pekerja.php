<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Pekerja;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use mdm\widgets\TabularInput;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Pekerja */
/* @var $form yii\widgets\ActiveForm */
?>

<td>
<?= Html::hiddenInput("input2-$key-id", '', ['id' => "input2-$key-id"]); ?>
<?= Html::hiddenInput("input2-$key-ket", '', ['id' => "input2-$key-ket"]); ?>

<?= Html::hiddenInput("input2-$key-id1", '', ['id' => "input2-$key-id1"]); ?>
<?= Html::hiddenInput("input2-$key-ket1", '', ['id' => "input2-$key-ket1"]); ?>


   <?= $form->field($model, "[$key]id_sd_rab")->widget(DepDrop::classname(), [
        'type' => DepDrop::TYPE_SELECT2,
        'data' => [$model->id_sd_rab => is_null($model->sdRab) ? "--" : $model->sdRab->nama_level_jabatan],
        'options' => ['placeholder' => 'Pilih Level Jabatan ...'],
        'select2Options' => ['pluginOptions' => ['allowClear' => true],

            'pluginEvents' => [
                "select2:select" => "function(e) {    $('input[name=input2-".$key."-id]').val(e.params.data.id);$('input[name=input2-".$key."-ket]').val(e.params.data.text);
$.post( '".Url::to(['realisasi/gajipekerja'])."?id=' +$(this).val(), function(data) {

                                                  data1 = JSON.parse(data)
                                                  $( '#d_realisasi_pekerja-$key-gaji' ).val(data1.gaji);
                                                  $( '#d_realisasi_pekerja-$key-sub_total' ).val(data1.gaji);

}
);

                }"    ,

                ]

    ],
        'pluginOptions' => [
            'depends' => ['realisasi-id_d_rab'],
            'url' => Url::to(['/realisasi/leveljabatan']),
            'placeholder' => 'Pilih Level Jabatan ...',
            'initialize' => true,
            'params' => ["input2-$key-id", "input2-$key-ket"]

        ],

    ])->label(false) ?></td>

<td>

   <?= $form->field($model, "[$key]id_karyawan")->widget(DepDrop::classname(), [
        'type' => DepDrop::TYPE_SELECT2,
        'data' => [$model->id_karyawan => is_null($model->karyawan) ? "--" : $model->karyawan->nama_karyawan],
        'options' => ['placeholder' => 'Pilih Karyawan ...'],
        'select2Options' => ['pluginOptions' => ['allowClear' => true],

            'pluginEvents' => [
                "select2:select" => "function(e) {    $('input[name=input2-".$key."-id1]').val(e.params.data.id);$('input[name=input2-".$key."-ket1]').val(e.params.data.text);

                }"    ,

                ]

        ],
        'pluginOptions' => [
            'depends' => ["d_realisasi_pekerja-$key-id_sd_rab"],
            'url' => Url::to(['/realisasi/karyawan']),
            'placeholder' => 'Pilih Karyawan ...',
            'initialize' => true,
            'params' => ["input2-$key-id1", "input2-$key-ket1"]

        ],

    ])->label(false) ?></td>

<td>

<?= $form->field($model, "[$key]gaji")->textInput([

    'onChange' => ' var total =  parseFloat($(this).val()) ; $("#d_realisasi_pekerja-' . $key . '-sub_total").val(total)   ',

])->label(false) ?>

</td>

<td>
<?= $form->field($model, "[$key]sub_total")->textInput()->label(false) ?>

</td>

    <td>
    <a data-action="delete" id='delete1'><span class="glyphicon glyphicon-trash">
</td>