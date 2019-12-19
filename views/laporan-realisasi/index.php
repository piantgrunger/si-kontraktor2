
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\RAB;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\web\View;
use miloschuman\highcharts\Highcharts;

$this->registerCSSFile(Yii::$app->homeUrl.'js/gantt/codebase/dhtmlxgantt.css');

$this->registerJSFile(Yii::$app->homeUrl.'js/gantt/codebase/dhtmlxgantt.js', ['position' => View::POS_HEAD]);

$this->registerJSFile(Yii::$app->homeUrl.'js/gantt/codebase/api.js', ['position' => View::POS_HEAD]);

$data = ArrayHelper::map(
  RAB::find()
    ->select([
      'id_RAB', 'ket' => "[no_RAB]+' - '+[nama_customer]",
    ])
    ->innerJoin('tb_mt_proyek', 'tb_mt_proyek.id_proyek=tb_mt_RAB.id_proyek')
    ->innerJoin('tb_m_customer', 'tb_m_customer.id_customer=tb_mt_proyek.id_customer')
    ->asArray()
    ->all(),
  'id_RAB',
  'ket'
);

$form = ActiveForm::begin();

?>





<div class="site-index">

    <?= $form->field($model, 'id_rab')->widget(Select2::className(), [
      'data' => $data,
      'options' => ['placeholder' => 'Pilih RAB...'],
      'pluginOptions' => [
        'allowClear' => true,
      ],
    ])->label('RAB'); ?>


       <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>
    <label><input type="radio" name="scale" value="day" checked/>Harian</label>
<label><input type="radio" name="scale" value="week"/>Mingguan</label>
<label><input type="radio" name="scale" value="month"/>Bulanan</label>
<label><input type="radio" name="scale" value="year"/>Tahunan</label>


<div id="report" style='width:100%; height:300px;'>
    <div id="gantt_here" style='width:100%; height:100%;'></div>

<script type="text/javascript">

function setScaleConfig(level) {
    switch (level) {
        case "day":
            gantt.config.scale_unit = "day";
            gantt.config.step = 1;
            gantt.config.date_scale = "%d %M";
            gantt.templates.date_scale = null;

            gantt.config.scale_height = 27;

            gantt.config.subscales = [];
            break;
        case "week":
            var weekScaleTemplate = function (date) {
              var dateToStr = gantt.date.date_to_str("%d %M");
              var endDate = gantt.date.add(gantt.date.add(date, 1, "week"), -1, "day");
              return dateToStr(date) + " - " + dateToStr(endDate);
            };

            gantt.config.scale_unit = "week";
            gantt.config.step = 1;
            gantt.templates.date_scale = weekScaleTemplate;

            gantt.config.scale_height = 50;

            gantt.config.subscales = [
                {unit: "day", step: 1, date: "%D"}
            ];
            break;
        case "month":
            gantt.config.scale_unit = "month";
            gantt.config.date_scale = "%F, %Y";
            gantt.templates.date_scale = null;

            gantt.config.scale_height = 50;

            gantt.config.subscales = [
                {unit: "day", step: 1, date: "%j, %D"}
            ];

            break;
        case "year":
            gantt.config.scale_unit = "year";
            gantt.config.step = 1;
            gantt.config.date_scale = "%Y";
            gantt.templates.date_scale = null;

            gantt.config.min_column_width = 50;
            gantt.config.scale_height = 90;

            gantt.config.subscales = [
                {unit: "month", step: 1, date: "%M"}
            ];
            break;
    }
}

  gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
  gantt.config.readonly = true;
    gantt.init("gantt_here");
    <?php if ($model->id_rab !== '') {
        ?>
    gantt.load("laporan-realisasi/data?id_rab=<?=$model->id_rab; ?>");
    <?php
    } ?>
</script>
   <input value="Cetak" type="button" onclick='gantt.exportToPDF()' class = 'btn btn-success'>
<script type="text/javascript">
var els = document.querySelectorAll("input[name='scale']");
for (var i = 0; i < els.length; i++) {
    els[i].onclick = function(e){
        e = e || window.event;
        var el = e.target || e.srcElement;
        var value = el.value;
        setScaleConfig(value);
        gantt.render();
    };
}

</script>
</div>

<div>
<?php


echo Highcharts::widget([
  'scripts' => [
    'modules/exporting',
    'themes/grid-light',
  ],
  'options' => [
    'chart' => ['type' => 'spline',
  ],
    'title' => [
      'text' => 'Grafik Progress',
    ],
    'xAxis' => [
      'categories' => $dataTanggal,
    ],
    'yAxis' => [
      'title' => ['text' => 'Progress Progress (%)'],
    ],

    'series' => [
      [
        'name' => 'Progress',
        'data' => $chartData,
      ],
    ],
  ],
]);
?>

</div>
<div>
<?php


echo Highcharts::widget([
  'scripts' => [
    'modules/exporting',
    'themes/grid-light',
  ],
  'options' => [
    'chart' => ['type' => 'spline',
    ],
    'title' => [
      'text' => 'Grafik Progress Nilai Pekerjaan',
    ],
    'xAxis' => [
      'categories' => $dataTanggalRp,
    ],
    'yAxis' => [
      'title' => ['text' => 'Nilai Pekerjaan'],
    ],

    'series' => [
      [
        'name' => 'Progress',
        'data' => $chartData2,
      ],
    ],
  ],
]);
?>

</div>

</div>