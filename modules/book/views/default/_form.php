<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\book\models\Book $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $authors */
?>

<div class="book-form">

    <?php
    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_id')
        ->dropDownList($authors, ['prompt' => Yii::t('app', '-- Select author --')])
        ->label(Yii::t('app', 'Author')) ?>

    <?= $form->field($model, 'publisher')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publish_year')->textInput() ?>

    <?= $form->field($model, 'epigraph')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'page_count')->textInput() ?>

    <?= $form->field($model, 'pickup_last_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php
    ActiveForm::end(); ?>

</div>
