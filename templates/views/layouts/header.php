<?php
use yii\helpers\Html;

use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

<?php
NavBar::begin([
    'renderInnerContainer' => false, 'brandLabel' => "SI-Kontraktor",
    'brandOptions' => ['class' => 'logo'],//options of the brand
    'options' => [
        'class' => 'navbar navbar-default navbar-inverse',
        'role' => 'navigation',
    ],
]);
?>





        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">




                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">   <?=(Yii::$app->user->isGuest?'Guest':Yii::$app->user->identity->username);?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?=(Yii::$app->user->isGuest?'Guest':Yii::$app->user->identity->username);?>

                            </p>
                        </li>
                        <!-- Menu Body -->

                        <li class="user-body">

                        <!-- Menu Footer-->
                        <li class="user-footer">

                            <div class="pull-right">
                                <?=(Yii::$app->user->isGuest?Html::a(
                                    'Login',
                                    ['/site/login'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                    )
                                    :Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                )) ?>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
 <?php NavBar::end() ?>
</header>
