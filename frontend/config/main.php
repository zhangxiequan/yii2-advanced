<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'homeUrl'=>Yii::getAlias('@frontendUrl'),
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'site/index', 
    'bootstrap' => ['log'],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'common\lib\components\UrlManager', //'yii\web\urlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'enableDefaultLanguageUrlCode' => true,
            'languages' => ['cn' => 'zh-CN','en' => 'en-US'],
            'ruleConfig' => [
                'class' => 'yii\web\UrlRule', //'common\lib\components\LanguageUrlRule'
                'encodeParams' => false,
            ],
            'rules' => [
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ]
        ],
        'cache' => require(__DIR__.'/_cache.php'),
    ],
    'params' => $params,
];
