<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    // 'options' => [
    //     'class' => 'navbar-inverse navbar-fixed-top',
    // ],
]);
$menuItems = [
    ['label' => 'Home', 'url' => ['/site/index']],
    [
        'label' => 'Users', 
        //'url' => ['/user'],
        'items' => [
            ['label' => 'Users', 'url' => '/user'],
            '<li class="divider"></li>',
            '<li class="dropdown-header">RBAC</li>',
            ['label' => 'Assigment', 'url' => '/rbac/assignment'],
            ['label' => 'Roles', 'url' => '/rbac/role'],                                         
            ['label' => 'Permissions', 'url' => '/rbac/permission'],                                         
            // ['label' => 'Rules', 'url' => '/rbac/rule'],                                         
        ]
    ],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();
