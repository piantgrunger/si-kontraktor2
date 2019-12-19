
<?php
use yii\helpers\Html;
use hscstudio\mimin\components\Mimin;

$this->registerCSSFile('css/metro-all.css');

$this->registerJSFile(Yii::$app->homeUrl.'js/metro.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);

/* @var $this yii\web\View */
$js = "
    if ($.trim($('#authetication').text()) == '')
    $('#authetication').remove();
        if ($.trim($('#master').text()) == '')
    $('#master').remove();
            if ($.trim($('#transaction').text()) == '')
    $('#transaction').remove();
            if ($.trim($('#report').text()) == '')
    $('#report').remove();

    ";
$this->registerJS($js);

?>


<div class="site-index">

<div class="tiles-grid tiles-group size-1" id="authetication" >
    <?= (Mimin::checkRoute('mimin/route')) ? Html::a("

        <span class='mif-user icon'></span>
        <span class='branding-bar'>Route</span>
         ", ['/mimin/route'], ['data-role' => 'tile', 'class ' => 'bg-indigo']) : ''; ?>
    <?= (Mimin::checkRoute('mimin/role')) ? Html::a("

        <span class='mif-user icon'></span>
        <span class='branding-bar'>Role</span>
         ", ['/mimin/role'], ['data-role' => 'tile', 'class ' => 'bg-cyan']) : ''; ?>
    <?= (Mimin::checkRoute('mimin/user')) ? Html::a("

        <span class='mif-user icon'></span>
        <span class='branding-bar'>User</span>
         ", ['/mimin/user'], ['data-role' => 'tile', 'class ' => 'bg-red']) : ''; ?>

</div>

<div class="tiles-grid tiles-group size-2" data-group-title="" id="master" >
    <?= (Mimin::checkRoute('level-jabatan/index')) ? Html::a("

        <span class='mif-flow-tree icon'></span>
        <span class='branding-bar'>Level Jabatan</span>
         ", ['/level-jabatan'], ['data-role' => 'tile', 'class ' => 'bg-pink']) : ''; ?>
    <?= (Mimin::checkRoute('karyawan/index')) ? Html::a("

        <span class='mif-users icon'></span>
        <span class='branding-bar'>Karyawan</span>
         ", ['/karyawan'], ['data-role' => 'tile', 'class ' => 'bg-cyan']) : ''; ?>
    <?= (Mimin::checkRoute('jenis-pekerjaan/index')) ? Html::a("

        <span class='mif-folder icon'></span>
        <span class='branding-bar'>Level-Pekerjaan</span>
         ", ['/jenis-pekerjaan'], ['data-role' => 'tile', 'class ' => 'bg-blue']) : ''; ?>
 <?= (Mimin::checkRoute('pekerjaan/index')) ? Html::a("

        <span class='mif-hammer icon'></span>
        <span class='branding-bar'>Pekerjaan</span>
         ", ['/pekerjaan'], ['data-role' => 'tile', 'class ' => 'bg-green']) : ''; ?>

<?= (Mimin::checkRoute('rekanan/index')) ? Html::a("

        <span class='mif-loop icon'></span>
        <span class='branding-bar'>Rekanan</span>
         ", ['/rekanan'], ['data-role' => 'tile', 'class ' => 'bg-grey']) : ''; ?>

 <?= (Mimin::checkRoute('material/index')) ? Html::a("

        <span class='mif-layers icon'></span>
        <span class=branding-bar'>Alat dan Material</span>
         ", ['/material'], ['data-role' => 'tile', 'class ' => 'bg-yellow']) : ''; ?>
<?= (Mimin::checkRoute('jenisbangunan/index')) ? Html::a("

        <span class='mif-shop icon'></span>
        <span class=branding-bar'>Jenis Bangunan</span>
         ", ['/jenisbangunan'], ['data-role' => 'tile', 'class ' => 'bg-red']) : ''; ?>


</div>
<div class="tiles-grid tiles-group size-3" data-group-title="" id = "transaction" >

 <?= (Mimin::checkRoute('customer/index')) ? Html::a("

        <span class='mif-user-check icon'></span>
        <span class='branding-bar'>Customer</span>
         ", ['/customer'], ['data-role' => 'tile', 'class ' => 'bg-red', 'data-size' => 'medium']) : ''; ?>

   <?= (Mimin::checkRoute('proyek/index')) ? Html::a("

        <span class='mif-location-city icon'></span>
        <span class='branding-bar'>Proyek</span>
         ", ['/proyek'], ['data-role' => 'tile', 'class ' => 'bg-pink']) : ''; ?>


  <?= (Mimin::checkRoute('rab/index')) ? Html::a("

        <span class='mif-calculator icon'></span>
        <span class='branding-bar'>R A B</span>
         ", ['/rab'], ['data-role' => 'tile', 'class ' => 'bg-green', 'data-size' => 'wide']) : ''; ?>


  <?= (Mimin::checkRoute('history/index')) ? Html::a("

        <span class='mif-copy icon'></span>
        <span class='branding-bar'>History R A P</span>
         ", ['/history'], ['data-role' => 'tile', 'class ' => 'bg-blue']) : ''; ?>


  <?= (Mimin::checkRoute('rab/rap')) ? Html::a("

        <span class='mif-calculator icon'></span>
        <span class='branding-bar'>R A P</span>
         ", ['/rab/rap'], ['data-role' => 'tile', 'class ' => 'bg-blue']) : ''; ?>



<?= (Mimin::checkRoute('realisasi/index')) ? Html::a("

        <span class='mif-library icon'></span>
        <span class='branding-bar'>Progress</span>
         ", ['/realisasi'], ['data-role' => 'tile', 'class ' => 'bg-purple', 'data-size' => 'medium']) : ''; ?>




 <?= (Mimin::checkRoute('laporan-realisasi/index')) ? Html::a("

        <span class='mif-chart-line icon'></span>
        <span class='branding-bar'>Laporan Progress</span>
         ", ['/laporan-realisasi'], ['data-role' => 'tile', 'class ' => 'bg-red', 'data-size' => 'medium']) : ''; ?>

</div>


</div>
