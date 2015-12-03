<?php

    namespace app\modules\test_task;

    use yii\web\AssetBundle;

    class AppAsset extends AssetBundle
    {
        public $sourcePath = '@app/modules/test_task/assets';
        public $css = [
            'css/style.css',
            'css/imagelightbox.css',
        ];
        public $js = [
            'js/imagelightbox.min.js',
            'js/script.js',
        ];
        public $depends = [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
        ];
    }
