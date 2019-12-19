<?php

foreach ($model as $list) {
    echo  $this->render('view_rekap', ['model' => $list]);
    echo '<br>';
}
