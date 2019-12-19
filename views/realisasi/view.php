<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Realisasi */

$this->title = $model->no_realisasi;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Progress'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realisasi-view">

    <h1><?= Html::encode($this->title); ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no_realisasi',
            'no_rab',
            'nama_pekerjaan',

            'tgl_aw_realisasi',
            'tgl_ak_realisasi',
            'qty',
            'total_biaya_material',
            'total_biaya_pekerja',
            'total_biaya_peralatan',
            'keterangan:ntext',
        ],
    ]); ?>


<div class="panel panel-primary"   >
<div class="panel-heading"> Data Progress

</div>
<div style ="margin-top:10px;margin-bottom:10px;margin-left:10px">

<h4> Data Material</h4>
<table class="table table-condensed table-striped table-hover table-bordered">
<thead>
<tr>

            <th>Material</th>
            <th align="right">Qty</th>
           <th align="right">Harga</th>
           <th align="right">Sub Total</th>
        </tr>
 </thead>
 <tbody>
      <?php
        foreach ($model->det_realisasi_material as $material) {
            echo '<tr>';
            echo "<td>$material->nama_material </td>";
            echo "<td>$material->qty </td>";
            echo "<td>$material->harga </td>";
            echo "<td>$material->sub_total </td>";

            echo '</tr>';
        }

        ?>
 </tbody>
 <tfoot>
 <tr>
 <td></td>
 <td></td>
 <th>Total</th>
 <th><?= $model->total_biaya_material; ?></th>

 </tr>
 </tfoot>

</table>

<h4> Data Peralatan</h4>
<table class="table table-condensed table-striped table-hover table-bordered">
<thead>
<tr>

            <th>Peralatan</th>
            <th align="right">Qty</th>
           <th align="right">Harga</th>
           <th align="right">Sub Total</th>
        </tr>
 </thead>
 <tbody>
      <?php
        foreach ($model->det_realisasi_peralatan as $material) {
            echo '<tr>';
            echo "<td>$material->nama_material </td>";
            echo "<td>$material->qty </td>";
            echo "<td>$material->harga </td>";
            echo "<td>$material->sub_total </td>";

            echo '</tr>';
        }

        ?>
 </tbody>
 <tfoot>
 <tr>
 <td></td>
 <td></td>
 <th>Total</th>
 <th><?= $model->total_biaya_peralatan; ?></th>

 </tr>
 </tfoot>

</table>

<h4> Data Pekerja</h4>
<table class="table table-condensed table-striped table-hover table-bordered">
<thead>
<tr>

            <th>Level Jabatab</th>
            <th>Karyawan</th>
           <th align="right">Gaji</th>
           <th align="right">Sub Total</th>
        </tr>
 </thead>
 <tbody>
      <?php
        foreach ($model->det_realisasi_pekerja as $material) {
            echo '<tr>';
            echo "<td>$material->nama_level_jabatan </td>";
            echo "<td>$material->nama_karyawan </td>";
            echo "<td>$material->gaji </td>";
            echo "<td>$material->sub_total </td>";

            echo '</tr>';
        }

        ?>
 </tbody>
 <tfoot>
 <tr>
 <td></td>
 <td></td>
 <th>Total</th>
 <th><?= $model->total_biaya_pekerja; ?></th>

 </tr>
 </tfoot>

</table>

</div>


</div>

</div>
