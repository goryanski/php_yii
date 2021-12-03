<?php

use app\api\modules\v1\business\services\interfaces\IStudentsService;
use app\api\modules\v1\business\services\StudentsService;
use app\api\modules\v1\repositories\interfaces\IStudentsRepository;
use app\api\modules\v1\repositories\StudentsRepository;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    // include module
    'modules' => [
        'v1' => [
            'class' => app\api\modules\v1\Module::class,
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'enLBoB33sptY3GipJD5QwndydWDIz7Mf',
            // set json format
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // set also enableStrictParsing and rules
            'enableStrictParsing' => true,
            'rules' => [
                [
                    'class' => yii\rest\UrlRule::class,
                    'controller' => ['v1/students'],
                    'prefix' => 'api',
                    'extraPatterns' => [
                        'GET /' => 'index',
                        'GET groups' => 'groups',
                        'DELETE /' => 'delete',
                        'POST add' => 'add',
                        'GET getOne' => 'get',
                        'POST edit' => 'edit'
                    ]
                ],
            ],
        ],
    ],
    'params' => $params,
];

// Inject
Yii::$container->set(IStudentsRepository::class, StudentsRepository::class);
Yii::$container->set(IStudentsService::class, StudentsService::class);

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
