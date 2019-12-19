<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Pekerjaan;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use mdm\widgets\TabularInput;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\RAB */
/* @var $form yii\widgets\ActiveForm */
?>
<td>
 <b><?= (Yii::$app->params['kelompok_material'] === $model->kelompok_material) ? "" : $model->kelompok_material; ?></b>

</td>
<td>
<?=$model->material_detail;?>
</td>

<td align="right">
<?= Yii::$app->formatter->asDecimal($model->harga); ?>
</td>
<?php Yii::$app->params['kelompok_material'] = $model->kelompok_material;?>