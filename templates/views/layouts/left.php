<?php
use hscstudio\mimin\components\Mimin;
$menuItems =
        [
                    ['label' => 'Gii' ,'icon' => 'fa fa-file-code-o', 'url' => ['/gii/'],'visible' => !Yii::$app->user->isGuest],
                    [
                        'visible' => !Yii::$app->user->isGuest,
                        'label' => 'User / Group',
                        'icon' => 'user-circle',
                        'url' => '#',
                        'items' => [
                    ['label' => 'App. Route' , 'icon' =>  'user', 'url' => ['/mimin/route/'],'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Role' , 'icon' =>  'user', 'url' => ['/mimin/role/'],'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'User' , 'icon' => 'user', 'url' => ['/mimin/user/'],'visible' => !Yii::$app->user->isGuest],
                   ]]
                        ,
            [
                        'visible' => !Yii::$app->user->isGuest,
                        'label' => 'Master',
                        'icon' => 'database',
                        'url' => '#',
                        'items' => [
                    ['label' => 'Material / Peralatan' , 'icon' =>  'cubes', 'url' => ['/material/index'],'visible' => !Yii::$app->user->isGuest],
                   ['label' => 'Customer', 'icon' => 'address-book-o', 'url' => ['/customer/index'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'Jenis Pekerjaan', 'icon' => 'folder', 'url' => ['/jenis-pekerjaan/index'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'Pekerjaan', 'icon' => 'gavel', 'url' => ['/pekerjaan/index'], 'visible' => !Yii::$app->user->isGuest],
               ['label' => 'Level Jabatan', 'icon' => 'unsorted', 'url' => ['/level-jabatan/index'], 'visible' => !Yii::$app->user->isGuest],
             ['label' => 'Karyawan', 'icon' => 'users', 'url' => ['/karyawan/index'], 'visible' => !Yii::$app->user->isGuest],

                   ]],

    [
        'visible' => !Yii::$app->user->isGuest,
        'label' => 'Transaksi',
        'icon' => 'money',
        'url' => '#',
        'items' => [
            ['label' => 'Proyek', 'icon' => 'building', 'url' => ['/proyek/index'], 'visible' => !Yii::$app->user->isGuest],

        ]
    ],


                ];

 if (!Yii::$app->user->isGuest)
{
 if (Yii::$app->user->identity->username !== 'admin')
{
  $menuItems = Mimin::filterMenu($menuItems);
}
}
?>
<aside class="main-sidebar">

    <section class="sidebar">



        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree'],
                'items' => $menuItems,
            ]
        ) ?>

    </section>

</aside>
