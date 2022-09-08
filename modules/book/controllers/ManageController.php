<?php

namespace app\modules\book\controllers;

use app\modules\book\models\Book;
use app\modules\book\models\ManageBook;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ManageController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionPickup(int $id)
    {
        if (($model = $this->findModel($id)) !== null) {
            (new ManageBook($model))->pickup();
        }

        return $this->redirect(['default/index']);
    }

    public function actionReturn(int $id)
    {
        if (($model = $this->findModel($id)) !== null) {
            (new ManageBook($model))->return();
        }

        return $this->redirect(['default/index']);
    }

    protected function findModel($id)
    {
        if (($model = Book::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
