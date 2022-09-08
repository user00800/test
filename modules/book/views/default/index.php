<?php

use app\modules\book\assets\BookAsset;
use app\modules\book\models\Book;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\book\models\BookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title                   = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;

BookAsset::register($this);
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Book'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'author_id',
            'publisher',
            'publish_year',
            //'epigraph:ntext',
            //'page_count',
            //'pickup_last_date',
            [
                'format' => 'raw',
                'value'  => function ($model) {
                    if ($model->isPickuped) {
                        if ($model->lastPickuped->user->id === Yii::$app->user->id) {
                            return Html::button(
                                Yii::t('app', 'Return'),
                                [
                                    'class' => 'book-return',
                                    'data'  => ['url' => Url::to(['/book/manage/return', 'id' => $model->id])],
                                ]
                            );
                        }

                        return Yii::t('app', 'Pickuped another user');
                    }

                    return Html::button(
                        Yii::t('app', 'Pickup'),
                        [
                            'class' => 'book-pickup',
                            'data'  => ['url' => Url::to(['/book/manage/pickup', 'id' => $model->id])]
                        ]
                    );
                }
            ],
            [
                'class'      => ActionColumn::className(),
                'urlCreator' => function ($action, Book $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
