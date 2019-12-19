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

/* @var $this yii\web\View */
/* @var $model app\models\RAB */
/* @var $form yii\widgets\ActiveForm */
?>
<div style ="margin-top:10px;margin-bottom:10px;margin-left:10px">
<div class="row">
<div class="col-sm-4">
    <?= $model->nama_pekerjaan ?>(  <?= $model->status_pekerjaan ?> )</div>
<div class="col-sm-2">
  Qty :  <?= $model->qty ?> <?= $model->satuan ?> </div>
<div class="col-sm-2">
 Hari Kerja :   <?= $model->hari_kerja ?> Hari</div>

</div>
<h4> Data Material</h4>
<table class="table table-condensed table-striped table-hover table-bordered">
<thead>
<tr>

            <th>Material</th>
            <th>Qty</th>
           <th>Harga</th>
           <th>Sub Total</th>
        </tr>
 </thead>
 <tbody>
      <?php
          foreach($model->sDetailRabMaterial as $material)
          {
              echo "<tr>";
              echo "<td>$material->nama_material </td>";
              echo "<td>$material->qty </td>";
              echo "<td>$material->harga </td>";
              echo "<td>$material->sub_total </td>";

               echo "</tr>";

          }

      ?>
 </tbody>
 <tfoot>
 <tr>
 <td></td>
 <td></td>
 <th>Total</th>
 <th><?=$model->total_biaya_material?></th>

 </tr>
 </tfoot>

</table>

<h4> Data Peralatan</h4>
<table class="table table-condensed table-striped table-hover table-bordered">
<thead>
<tr>

            <th>Peralatan</th>
            <th>Qty</th>
           <th>Harga</th>
           <th>Sub Total</th>
        </tr>
 </thead>
 <tbody>
      <?php
        foreach ($model->sDetailRabPeralatan as $material) {
            echo "<tr>";
            echo "<td>$material->nama_material </td>";
            echo "<td>$material->qty </td>";
            echo "<td>$material->harga </td>";
            echo "<td>$material->sub_total </td>";

            echo "</tr>";

        }

        ?>
 </tbody>
 <tfoot>
 <tr>
 <td></td>
 <td></td>
 <th>Total</th>
 <th><?= $model->total_biaya_peralatan ?></th>

 </tr>
 </tfoot>

</table>

<h4> Data Pekerja</h4>
<table class="table table-condensed table-striped table-hover table-bordered">
<thead>
<tr>

            <th>Level Jabatan</th>
            <th>Qty</th>
           <th>Gaji</th>
           <th>Sub Total</th>
        </tr>
 </thead>
 <tbody>
      <?php
        foreach ($model->sDetailRabPekerja as $material) {
            echo "<tr>";
            echo "<td>$material->nama_level_jabatan </td>";
            echo "<td>$material->qty </td>";
            echo "<td>$material->gaji </td>";
            echo "<td>$material->sub_total </td>";

            echo "</tr>";

        }

        ?>
 </tbody>
  <tfoot>
 <tr>
 <td></td>
 <td></td>
 <th>Total</th>
 <th><?= $model->total_biaya_pekerja ?></th>

 </tr>
 </tfoot>

</table>
</div>
