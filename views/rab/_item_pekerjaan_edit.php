<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pekerjaan */
/* @var $form yii\widgets\ActiveForm */

/* @var $this yii\web\View */
/* @var $model app\models\RAB */
/* @var $form yii\widgets\ActiveForm */
?>
<div style ="margin-top:10px;margin-bottom:10px;margin-left:10px">
<div class="row">
<div class="col-sm-4">
    <?= $model->nama_pekerjaan_detail; ?></div>
<div class="col-sm-2">
  Qty :  <?= $model->qty; ?> <?= $model->satuan; ?> </div>
<div class="col-sm-2">
 Hari Kerja :   <?= $model->hari_kerja; ?> Hari</div>


<div class="col-sm-2">
    <?=Html::a(Yii::t('app', 'Ubah'), ['pekerjaan', 'id' => $model->id_d_rab], ['class' => 'btn btn-primary']); ?>
</div>
</div>
<table class="table table-condensed table-striped table-hover table-bordered">
<thead>
<tr>

            <th >Item</th>
            <th align="Right">Qty</th>
            <th >Satuan</th>

           <th align="Right">Harga / Upah</th>

           <th align="Right">Sub Total</th>
     
        </tr>
 </thead>
 <tbody>
      <?php
        foreach ($model->sDetailRabMaterial as $material) {
            echo '<tr>';
            echo "<td>$material->nama_material </td>";
            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->qty).' </td>';
            echo "<td>$material->satuan </td>";

            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->harga).' </td>';
            echo "<td align='Right'> ".Yii::$app->formatter->asDecimal($material->sub_total).' </td>';

            echo '</tr>';
        }

        foreach ($model->sDetailRabPeralatan as $material) {
            echo '<tr>';
            echo "<td>$material->nama_material </td>";

            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->qty).' </td>';
            echo "<td>$material->satuan </td>";
            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->harga).'</td>';
            echo "<td align='Right'> ".Yii::$app->formatter->asDecimal($material->sub_total).' </td>';

            echo '</tr>';
        }
        foreach ($model->sDetailRabPekerja as $material) {
            echo '<tr>';
            echo "<td>$material->nama_level_jabatan </td>";
            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->qty).' </td>';
            echo "<td>$material->satuan </td>";
            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->gaji).'</td>';
            echo "<td align='Right'> ".Yii::$app->formatter->asDecimal($material->sub_total).' </td>';

            echo '</tr>';
        }

        ?>
 </tbody>
 <tfoot>
 <tr>
 <td></td>
 <td></td>
 <td></td>

 <th>Total</th>

 <td align="Right"><?= Yii::$app->formatter->asDecimal($model->total_rab); ?></td>

 </tr>
<tr>
 <td></td>
 <td></td>
 <td></td>

 <th>Pagu</th>

 <td align="Right"><?= Yii::$app->formatter->asDecimal($model->nilai_pagu); ?></td>

 </tr>

 <tr>
 <td></td>
 <td></td>
 <td></td>


 <th>Retensi <?= Yii::$app->formatter->asDecimal($model->retensi_persen); ?> %  </th>

 <td align="Right"><?= Yii::$app->formatter->asDecimal($model->retensi_rp); ?></td>

 </tr>

 </tfoot>

</table>

</div>
