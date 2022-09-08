<?php

namespace app\modules\book\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;
use yii\bootstrap4\BootstrapAsset;

class BookAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/book/web';

    public $js = [
        'js/book.js',
    ];

    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
    ];
}
