<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        //通过access token 存钱令牌
        'user' => [
            'identityClass' => 'common\models\Adminuser',
            'enableAutoLogin' => true,
            'enableSession' => false,
            // 'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        // 'session' => [
            // this is the name of the session cookie used for login on the backend
            // 'name' => 'advanced-backend',
        // ],
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
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
            ['class' => 'yii\rest\UrlRule',
                'controller' => 'article',
                'extraPatterns'=>['POST search' => 'search'],
            ],

           ['class'=>'yii\rest\UrlRule',
                    'controller'=>'top',
                    'except'=>['delete','create','update','view'],
                    'pluralize'=>false,
                ],
            ['class' => 'yii\rest\UrlRule',
            'controller' => 'adminuser',
            'extraPatterns' => [
                        'POST login' => 'login',
                    ]],
            // [
            //     'class' => 'yii\rest\UrlRule',
            //     'controller' => ['v1/user'],
            //     'extraPatterns' => [
            //         'POST login' => 'login',
            //         'GET signup-test' => 'signup-test',
            //     ]
            // ],
          
            ],
        ],
        
    ],
    'params' => $params,
];
