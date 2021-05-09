<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name' => 'Backend Guru',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['gii'],
    'modules' => [],
    'components' => [
        'assetManager' => [
            'appendTimestamp' => true
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
    ],
    'modules' => [
        'gridview' => ['class' => 'kartik\grid\Module'],
        'gii' => [
            'class' => 'yii\gii\Module',
        ],
        'rbac' =>  [
            'class' => 'app\rbacplus\Module',
            'userModelClassName'=>null,
            'userModelIdField'=>'id',
            'userModelLoginField'=>'username',
            'userModelLoginFieldLabel'=>null,
            'userModelExtraDataColumls'=>[
                [
                    'attributes' => 'group_id',
                    // 'value'=>function($model){
                    //     return $model->group_id;
                    // }
                ]
            ],
            'beforeCreateController'=>null,
            'beforeAction'=>null
        ]
    ],
    'params' => $params,
];
