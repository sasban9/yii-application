<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'admin/*',
            'site/*',
            'rbac/*',
            'gii/*',
            'user/*',
            'debug/*'
        ]
    ],
    'components' => [
        'assetManager' => [
            'appendTimestamp' => true,
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
                'rbac/user/view/<username>' => 'user/view',
                //'admin/user' => 'user/index',
            ],
        ],
        
    ],
    'modules' => [
        'rbac' =>  [
            'class' => 'johnitvn\rbacplus\Module',
            'userModelClassName'=>null,
            'userModelIdField'=>'id',
            'userModelLoginField'=>'username',
            'userModelLoginFieldLabel'=>null,
            'userModelExtraDataColumls'=>null,
            'beforeCreateController'=>null,
            'beforeAction'=>null
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'controllerMap' => [
                'assignment' => [
                   'class' => 'mdm\admin\controllers\AssignmentController',
                   /* 'userClassName' => 'app\models\User', */
                   'idField' => 'id',
                   'usernameField' => 'email',
                   'fullnameField' => 'firstname',
                   'extraColumns' => [
                       [
                           'attribute' => 'full_name',
                           'label' => 'Full Name',
                           'value' => function($model, $key, $index, $column) {
                               return $model->email;
                           },
                       ],
                       [
                           'attribute' => 'email',
                           'label' => 'Email',
                           'value' => function($model, $key, $index, $column) {
                               return $model->email;
                           },
                       ],
                       [
                           'attribute' => 'status',
                           'label' => 'Status',
                           'value' => function($model, $key, $index, $column) {
                               return $model->status_id;
                           },
                       ],
                   ],
                   'searchClass' => 'app\models\UserSearch'
               ],
           ],
        ],
        'gridview' => [
            'class' => 'kartik\grid\Module',
            #'class' => 'yii\grid\GridView',
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
        ]
    ],
    'params' => $params,
];
