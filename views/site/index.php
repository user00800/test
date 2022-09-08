<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2><?= \yii\helpers\Html::a(Yii::t('app', 'Go to Authors'), ['/author/default/index']) ?></h2>
            </div>
            <div class="col-lg-6">
                <h2><?= \yii\helpers\Html::a(Yii::t('app', 'Go to Books'), ['/book/default/index']) ?></h2>
            </div>
        </div>

    </div>
</div>
