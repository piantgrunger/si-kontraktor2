<?php


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



</div>
<table class="table table-condensed table-striped table-hover table-bordered">
<thead>
<tr>

            <th >Item</th>
            <th align="Right">Qty</th>
            <th >Satuan</th>

           <th align="Right">Harga / Upah</th>

           <th align="Right">Sub Total</th>

           <th align="Right">Qty Progress</th>
                <th align="Right">Sub tot  Progress</th>
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
            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->qty_realisasi).' </td>';
            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->sub_tot_realisasi).' </td>';

            echo '</tr>';
        }

        foreach ($model->sDetailRabPeralatan as $material) {
            echo '<tr>';
            echo "<td>$material->nama_material </td>";

            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->qty).' </td>';
            echo "<td>$material->satuan </td>";
            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->harga).'</td>';
            echo "<td align='Right'> ".Yii::$app->formatter->asDecimal($material->sub_total).' </td>';
            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->qty_realisasi).' </td>';
            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->sub_tot_realisasi).' </td>';

            echo '</tr>';
        }
        foreach ($model->sDetailRabPekerja as $material) {
            echo '<tr>';
            echo "<td>$material->nama_level_jabatan </td>";
            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->qty).' </td>';
            echo "<td>$material->satuan </td>";
            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->gaji).'</td>';
            echo "<td align='Right'> ".Yii::$app->formatter->asDecimal($material->sub_total).' </td>';
            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->qty_realisasi).' </td>';
            echo "<td align='Right'>".Yii::$app->formatter->asDecimal($material->sub_tot_realisasi).' </td>';

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

 <th>Premise <?= Yii::$app->formatter->asDecimal(((($model->total_rab==0)?0: $model->progress / $model->total_rab)*100)); ?> %  </th>

 <td align="Right"><?= Yii::$app->formatter->asDecimal($model->progress); ?></td>

 </tr>

 </tfoot>

</table>

</div>
