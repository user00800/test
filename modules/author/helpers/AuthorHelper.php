<?php

namespace app\modules\author\helpers;

use app\modules\author\models\Author;
use yii\helpers\ArrayHelper;

class AuthorHelper
{
    public static function list()
    {
        $authors = Author::find()->all();

        return ArrayHelper::map($authors, 'id', 'fullName');
    }
}
