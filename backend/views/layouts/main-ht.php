<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\widgets\adminsearch\AdminSearch;
use backend\widgets\notificationcentre\NotificationCentre;
use backend\widgets\ProfilePictureWidget;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Breadcrumbs;

// set the root folder
$rootFolder = '/account/';

// if there's a success message
if (Yii::$app->session->hasFlash('successMsg')) {
    // output javascript to show it
    $this->registerJs(
        "htDash.showSuccessNotification('" . str_replace("'", "\'", Yii::$app->session->getFlash('successMsg')) . "');",
        View::POS_READY,
        'success-msg'
    );
}

// if there's an error message
if (Yii::$app->session->hasFlash('errorMsg')) {
    // output javascript to show it
    $this->registerJs(
        "htDash.showErrorNotification('" . str_replace("'", "\'", Yii::$app->session->getFlash('errorMsg')) . "');",
        View::POS_READY,
        'error-msg'
    );
}
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
<head>

    <meta charset="<?= Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link rel="icon" type="image/png" href="/account/favicon.ico">
    <link rel="apple-touch-icon" sizes="57x57" href="/account/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/account/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/account/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/account/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/account/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/account/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/account/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/account/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/account/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/account/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/account/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/account/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/account/favicon-16x16.png">
    <link rel="manifest" href="/account/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/account/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <?= Html::csrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?> - <?= Yii::$app->params['siteName']; ?> Dashboard</title>

    <script>
        window.App = <?= json_encode([
            //'preferredTimeZone' => common\helpers\TimeZone::getPreferredTimeZone(),
            //'preferredLocale' => common\helpers\Locale::getPreferredLocale(),
            'dateFormat' => Yii::t('app', 'DD/MM/YYYY'),
            'dateTimeFormat' => Yii::t('app', 'DD/MM/YYYY [at] HH:mm'),
            'timeFormat' => Yii::t('app', 'HH:mm:ss'),
        ]); ?>
    </script>

    <?php $this->head(); ?>
</head>
<body>
<?php
// only include the analytics code on live
if (YII_ENV != 'dev') {
    ?>
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TH88C36" height="0" width="0"
                style="display:none;visibility:hidden"></iframe>
    </noscript>
    <?php
}
?>
<?php $this->beginBody(); ?>
<?php
// get the current user
$user = \Yii::$app->user;
?>
<div class="main-content" id="panel">
    <nav id="top-nav-bar" class="navbar navbar-horizontal navbar-expand-lg navbar-dark bg-gradient-horiz-primary">
        <div class="container d-flex justify-content-between">
            <div class="order-2 order-lg-1">
                <a href="<?= Url::to(['/account/index']); ?>" class="navbar-brand">
                    <img src="<?= Yii::$app->params['awsAssetsUrl']; ?>images/logo-white.svg" title="Dashboard Home"
                         alt="<?= Yii::$app->params['siteName']; ?> Logo"/>
                </a>
            </div>
            <div class="order-1 flex-lg-grow-1">
                <button id="left-nav-mobile-btn" class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbar" aria-controls="navbar-primary" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar">
                    <div class="navbar-collapse-header d-flex justify-content-between">
                        <div class="left d-lg-none">
                            &nbsp;
                        </div>
                        <div class="collapse-brand d-lg-none">
                            <a href="<?= Url::to(['/account/index']); ?>">
                                <img src="<?= Yii::$app->params['awsAssetsUrl']; ?>images/logo-white.svg"
                                     title="Dashboard Home" alt="<?= Yii::$app->params['siteName']; ?> Logo"/>
                            </a>
                        </div>
                        <div class="collapse-close align-self-center">
                            <button id="close-nav-dd" type="button" class="navbar-toggler" data-toggle="collapse"
                                    data-target="#navbar" aria-controls="navbar-primary" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                    <?php
                    echo Nav::widget([
                        'options' => [
                            'id' => 'left-nav-bar',
                            'class' => 'navbar-nav',
                        ],
                        'encodeLabels' => false,
                        'activateItems' => true,
                        'activateParents' => true,
                        'items' => [
                            [
                                'label' => '<i class="ni ni-chart-bar-32"></i>' . Yii::t('app', 'Dashboard'),
                                'url' => ['/account/index'],
                                'visible' => $user->can('viewEventList'),
                                'linkOptions' => [],
                            ],
                            [
                                'label' => '<i class="fas fa-plus"></i>' . Yii::t('app', 'Create'),
                                'url' => ['/events/create'],
                                'visible' => $user->can('viewEventList'),
                                'dropDownOptions' => [
                                    'class' => 'nav',
                                    'divOptions' => [
                                        'id' => 'create',
                                    ],
                                ],
                            ],
                            [
                                'label' => '<i class="ni ni-tag"></i>' . Yii::t('app', 'Manage'),
                                'url' => '#manage',
                                'visible' => $user->can('viewEventList'),
                                'dropDownOptions' => [
                                    'class' => 'nav',
                                    'divOptions' => [
                                        'id' => 'manage',
                                    ],
                                ],
                                'items' => [
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'View All Events'),
                                            'text' => Yii::t('app', 'Manage all of your events from one page'),
                                            'icon' => '<i class="fal fa-calendar-alt"></i>',
                                        ]),
                                        'url' => ['/events/index'],
                                        'visible' => $user->can('viewEventList'),
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'View All Assets'),
                                            'text' => Yii::t('app', 'Manage all of your assets'),
                                            'icon' => '<i class="fal fa-calendar"></i>',
                                        ]),
                                        'url' => ['/assets/index'],
                                        'visible' => $user->can('viewEventList'),
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Memberships'),
                                            'text' => Yii::t('app', 'Manage all of your memberships to your event'),
                                            'icon' => '<i class="fal fa-bookmark"></i>',
                                        ]),
                                        'url' => ['/memberships/index'],
                                        'visible' => $user->can('viewMemberships'),
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Branding'),
                                            'text' => Yii::t('app', 'Customise your event branding'),
                                            'icon' => '<i class="fal fa-pencil-alt"></i>',
                                        ]),
                                        'url' => ['/branding/index'],
                                        'visible' => $user->can('accessEventTools'),
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Integrations'),
                                            'text' => Yii::t('app', 'Connect & integrate other services to Helm'),
                                            'icon' => '<i class="fal fa-chart-network"></i>',
                                        ]),
                                        'url' => ['/integrations/index'],
                                        'visible' => $user->can('accessEventTools'),
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Scanning App'),
                                            'text' => Yii::t('app', 'Scan tickets on the door with our app'),
                                            'icon' => '<i class="fas fa-mobile-alt"></i>',
                                        ]),
                                        'url' => ['/events/scanning-app'],
                                        'visible' => $user->can('accessEventTools'),
                                        'linkOptions' => [],
                                    ],
                                ],
                            ],
                            [
                                'label' => '<i class="fas fa-megaphone"></i>' . Yii::t('app', 'Promote'),
                                'url' => '#promote',
                                'visible' => $user->can('accessEventTools'),
                                'dropDownOptions' => [
                                    'class' => 'nav',
                                    'divOptions' => [
                                        'id' => 'promote',
                                    ],
                                ],
                                'linkOptions' => [
                                    'data-toggle' => 'collapse',
                                ],
                                'items' => [
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Event Widget'),
                                            'text' => Yii::t('app', 'Embed your tickets on your website'),
                                            'icon' => '<span class="fa-stack">
                                                      <i class="fal fa-browser fa-stack-1x"></i>
                                                      <i class="fal fa-plus-circle fa-stack-1x"></i>
                                                    </span>',
                                        ]),
                                        'url' => ['/events/embed-all'],
                                        'visible' => $user->can('accessEventTools'),
                                        'linkOptions' => [
                                            'id' => 'event-widget',
                                            'data' => [
                                                'remote' => 'false',
                                                'toggle' => 'modal',
                                                'target' => '#otModal',
                                            ],
                                        ],
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Promoted Listing'),
                                            'text' => Yii::t('app', 'Learn more about promoted listings'),
                                            'icon' => '<i class="fal fa-bullhorn"></i>',
                                        ]),
                                        'url' => 'https://helmtickets.com/find-events/',
                                        'visible' => $user->can('accessEventTools'),
                                        'linkOptions' => [
                                            'target' => '_blank',
                                        ],
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Education Center'),
                                            'text' => Yii::t('app', 'Check out the latest tips and tickets for marketing'),
                                            'icon' => '<i class="fal fa-book-open"></i>',
                                        ]),
                                        'url' => 'https://helmtickets.com/blog/',
                                        'visible' => $user->can('accessEventTools'),
                                        'linkOptions' => [
                                            'target' => '_blank',
                                        ],
                                    ],
                                ],
                            ],
                            [
                                'label' => '<i class="fas fa-shopping-cart"></i>' . Yii::t('app', 'Buy Tickets'),
                                'url' => '/events/',
                                'visible' => !Yii::$app->user->isGuest,# && !$user->identity->isMoreThanTicketBuyer,
                            ],
                            [
                                'label' => '<i class="fal fa-ticket-alt"></i>' . Yii::t('app', 'Purchases'),
                                'url' => ['/orders/my-purchases'],
                                'visible' => !Yii::$app->user->isGuest,# && !$user->identity->isMoreThanTicketBuyer,
                            ],
                            [
                                'label' => '<i class="fal fa-id-badge"></i>' . Yii::t('app', 'Memberships'),
                                'url' => ['/account/user-memberships'],
                                'visible' => !Yii::$app->user->isGuest,# && $user->identity->hasSubscriptions && !$user->identity->isMoreThanTicketBuyer,
                            ],
                            [
                                'label' => '<i class="fal fa-gavel"></i>' . Yii::t('app', 'Admin'),
                                'url' => '#admin',
                                'visible' => !Yii::$app->user->isGuest && ($user->can('superAdmin') || $user->can('admin') || $user->can('statsAdmin')
                                        || $user->can('moderator') || $user->can('organiserCreditUser')
                                        || $user->can('organiserCreditModerator') || $user->can('creditCodeAdmin'))
                                    || $user->can('reportingUser'),
                                'dropDownOptions' => [
                                    'class' => 'nav',
                                    'divOptions' => [
                                        'id' => 'admin',
                                    ],
                                ],
                                'linkOptions' => [
                                    'data-toggle' => 'collapse',
                                ],
                                'items' => [
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'System Stats'),
                                            'text' => Yii::t('app', 'Up to date system stats'),
                                            'icon' => '<i class="fal fa-chart-pie"></i>',
                                        ]),
                                        'url' => ['/reporting/stats'],
                                        'visible' => ($user->can('superAdmin') || $user->can('statsAdmin')),
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Reporting'),
                                            'text' => Yii::t('app', 'Generate and run reports'),
                                            'icon' => '<i class="fal fa-table"></i>',
                                        ]),
                                        'url' => ['/reporting'],
                                        'visible' => ($user->can('reportingUser')),
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Organiser Details'),
                                            'text' => Yii::t('app', 'View organiser details such as verification status, address, referrer and estimated no. of tickets'),
                                            'icon' => '<i class="fal fa-info-circle"></i>',
                                        ]),
                                        'url' => ['/admin/organiser-details'],
                                        'visible' => ($user->can('viewOrganiserDetails') || $user->can('viewOrganiserBillingDetails')),
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'User Permissions'),
                                            'text' => Yii::t('app', 'Manage user permissions here'),
                                            'icon' => '<i class="fal fa-user-cog"></i>',
                                        ]),
                                        'url' => ['/rbac/assignment/index'],
                                        'visible' => $user->can('manageRbac'),
                                    ],
                                    /*[
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'User Rules'),
                                            'text' => Yii::t('app', 'Manage user rules here'),
                                            'icon' => '<i class="fal fa-clipboard-user"></i>',
                                        ]),
                                        'url' => ['/rbac/rule/index'],
                                        'visible' => $user->can('manageRbac'),
                                    ],*/
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Permissions'),
                                            'text' => Yii::t('app', 'Manage the permission names and descriptions'),
                                            'icon' => '<i class="fal fa-user-hard-hat"></i>',
                                        ]),
                                        'url' => ['/rbac/permission/index'],
                                        'visible' => $user->can('superAdmin'),
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'User Roles'),
                                            'text' => Yii::t('app', 'Manage each of the user roles that can be assigned to a user'),
                                            'icon' => '<i class="fal fa-user-circle"></i>',
                                        ]),
                                        'url' => ['/rbac/role/index'],
                                        'visible' => $user->can('superAdmin'),
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Moderation'),
                                            'text' => Yii::t('app', 'Review items that require moderation'),
                                            'icon' => '<i class="fal fa-clipboard-list-check"></i>',
                                        ]),
                                        'url' => ['/admin/moderation'],
                                        'visible' => $user->can('moderator') || $user->can('organiserCreditModerator'),
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Notifications'),
                                            'text' => Yii::t('app', 'Manage organiser notifications'),
                                            'icon' => '<i class="fal fa-bells"></i>',
                                        ]),
                                        'url' => ['/admin/notifications'],
                                        'visible' => $user->can('organiserNotificationAdmin'),
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Organiser Credit'),
                                            'text' => Yii::t('app', 'Manage organiser credit'),
                                            'icon' => '<i class="fal fa-coins"></i>',
                                        ]),
                                        'url' => ['/admin/organiser-credit'],
                                        'visible' => $user->can('organiserCreditUser') || $user->can('organiserCreditModerator'),
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Credit Codes'),
                                            'text' => Yii::t('app', 'Manage organiser credit codes'),
                                            'icon' => '<i class="fal fa-gift-card"></i>',
                                        ]),
                                        'url' => ['/admin/organiser-credit-codes'],
                                        'visible' => $user->can('creditCodesAdmin'),
                                    ],
                                ],
                            ],
                        ],
                    ]);

                    #$avatarImg = ProfilePictureWidget::widget(['id' => $user->getId()]);
                    ?>
                </div>
            </div>
            <div class="order-3 d-flex align-items-center">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <? NotificationCentre::widget(); ?>
                <?php endif; ?>
                <button id="right-nav-mobile-btn" class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbar-right" aria-controls="navbar-primary" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <? $avatarImg; ?>
                </button>
                <div class="collapse navbar-collapse" id="navbar-right">
                    <div class="navbar-collapse-header d-flex justify-content-between">
                        <div class="left d-lg-none">
                            &nbsp
                        </div>
                        <div class="collapse-brand d-lg-none">
                            <? $avatarImg; ?>
                        </div>
                        <div class="collapse-close align-self-center">
                            <button id="close-profile-dd" type="button" class="navbar-toggler" data-toggle="collapse"
                                    data-target="#navbar-right" aria-controls="navbar-primary" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                    <?php
                    echo Nav::widget([
                        'options' => [
                            'id' => 'right-nav-bar',
                            'class' => 'navbar-nav ml-auto',
                        ],
                        'encodeLabels' => false,
                        'activateItems' => true,
                        'activateParents' => true,
                        'items' => [
                            [
                                'label' => '<i class="fal fa-life-ring"></i>' . Yii::t('app', 'Help'),
                                'url' => 'https://support.helmtickets.com',
                                'linkOptions' => [
                                    'target' => '_blank',
                                ],
                            ],
                            [
                                'label' => 'AVATAR',
                                'url' => '#profile',
                                'linkOptions' => [
                                    'class' => 'avatar-wrap',
                                ],
                                'dropDownOptions' => [
                                    'id' => 'profile-dd',
                                ],
                                'visible' => !Yii::$app->user->isGuest,
                                'items' => [
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'My Details'),
                                            'text' => Yii::t('app', 'Edit your personal & business information'),
                                            'icon' => '<i class="fal fa-user-edit"></i>',
                                        ]),
                                        'url' => ['/account/profile'],
                                        'visible' => !Yii::$app->user->isGuest,
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Account Verification'),
                                            'text' => Yii::t('app', 'Verify your profile information'),
                                            'icon' => '<i class="fal fa-award"></i>',
                                        ]),
                                        'url' => ['/account/stripe-account-verification'],
                                        'visible' => (!empty($user->identity->stripe_connect_id) && $user->can('manageBillingDetails')),
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Account Upgrade'),
                                            'text' => Yii::t('app', 'Upgrade to an organiser account'),
                                            'icon' => '<i class="fal fa-arrow-circle-up"></i>',
                                        ]),
                                        'url' => ['account/upgrade-account'],
                                        'visible' => !Yii::$app->user->isGuest,
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Billing & Payouts'),
                                            'text' => Yii::t('app', 'Edit billing details, view payouts & statements'),
                                            'icon' => '<i class="fal fa-file-invoice"></i>',
                                        ]),
                                        'url' => ['/account/billing-details'],
                                        'visible' => $user->can('accessEventTools'),
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Memberships'),
                                            'text' => Yii::t('app', 'Manage your membership subscriptions'),
                                            'icon' => '<i class="fal fa-id-badge"></i>',
                                        ]),
                                        'url' => ['/account/user-memberships'],
                                        'visible' => !Yii::$app->user->isGuest,
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Referrals'),
                                            'text' => Yii::t('app', 'Refer other organisers and receive credit'),
                                            'icon' => '<i class="fal fa-user-friends"></i>',
                                        ]),
                                        'url' => ['account/user-referrals'],
                                        'visible' => !Yii::$app->user->isGuest,
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Purchases'),
                                            'text' => Yii::t('app', 'View your orders placed on Helm'),
                                            'icon' => '<i class="fal fa-ticket-alt"></i>',
                                        ]),
                                        'url' => ['/orders/my-purchases'],
                                        'visible' => !Yii::$app->user->isGuest,
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Buy Tickets'),
                                            'text' => Yii::t('app', 'Purchase tickets to other events on Helm'),
                                            'icon' => '<i class="fal fa-shopping-cart"></i>',
                                        ]),
                                        'url' => '/events/',
                                        'visible' => !Yii::$app->user->isGuest,
                                    ],
                                    [
                                        'label' => $this->renderFile('@app/views/layouts/dd-menu-item.php', [
                                            'title' => Yii::t('app', 'Logout'),
                                            'text' => Yii::t('app', 'Log out of your Helm Tickets account'),
                                            'icon' => '<i class="fal fa-user-times"></i>',
                                        ]),
                                        'url' => ['/account/logout'],
                                        'linkOptions' => ['data-method' => 'post'],
                                        'visible' => !Yii::$app->user->isGuest,
                                    ],
                                ],
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </nav>
    <div id="app">
        <div class="container" <?= (isset($this->params['sectionID'])) ? ' id="' . $this->params['sectionID'] . '"' : ''; ?>>
            <?php if ($user->can('superAdmin') || $user->can('admin')): ?>
                <?= AdminSearch::widget([
                    'query' => $this->params['adminSearchQuery'] ?? null,
                ]); ?>
            <?php endif; ?>

            <?php if (!$user->isGuest): ?>
                <div class="alert alert-warning">
                    <span class="alert-icon mr-px-10"><i class="fas fa-exclamation-triangle"></i></span>
                    <span class="alert-text">
                        <?= Yii::t('app', 'Warning! Paid ticket sales, asset bookings and membership sign ups are currently disabled until you have verified your account.'); ?>
                        <?= Yii::t('app', '<a href="{url}" title="Verify your account">Click here to verify now</a>.', ['url' => Url::to(['account/stripe-account-verification'])]); ?>
                    </span>
                </div>
            <?php endif; ?>
            <?php if (!isset($this->params['disableBreadCrumb'])) : ?>
                <?= Breadcrumbs::widget([
                    'options' => ['class' => 'd-none d-sm-flex breadcrumb'],
                    'homeLink' => ['label' => 'Dashboard', 'url' => ['/account/index']],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]); ?>

                <?php
                // if a last page breadcrumb is set and not empty
                if (isset($this->params['lastPageBreadcrumb']) && !empty($this->params['lastPageBreadcrumb'])) {
                    // output it
                    echo Breadcrumbs::widget([
                        'options' => ['class' => 'd-block d-sm-none breadcrumb'],
                        'homeLink' => false,
                        'links' => $this->params['lastPageBreadcrumb'],
                    ]);
                }
                ?>
            <?php
            endif;
            ?>
            <noscript>
                <div class="alert alert-danger">
                    To use this site's functionality, it is necessary to enable JavaScript.
                    Here are the <a href="https://www.enable-javascript.com/" target="_blank" rel="noopener">
                        instructions how to enable JavaScript in your web browser</a>.
                </div>
            </noscript>

            <?php if (!Yii::$app->user->isGuest): ?>
                <div class="alert alert-warning">
                    <?= Yii::t('app',
                        'Thank you for your sign up. Your registration is currently in the process of being manually checked. 
                                        You will receive an email once these checks have been completed and you can access your account. 
                                        We thank you for your patience.'); ?>
                </div>
            <?php endif; ?>

            <?= Alert::widget(); ?>
            <?= $content; ?>
            <?= $this->render('//common/modal'); ?>
        </div>
    </div>
    <div id="footer-cont" class="container-fluid">
        <div class="container">
            <footer class="footer">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <ul class="nav nav-footer text-lg-left justify-content-between justify-content-sm-start">
                            <li class="nav-item">
                                <a href="/about/" class="nav-link" target="_blank">
                                    <?= Yii::t('app', 'About'); ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/blog/" class="nav-link" target="_blank">
                                    <?= Yii::t('app', 'Blog'); ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="https://support.helmtickets.com" class="nav-link" target="_blank"
                                   rel="noopener">
                                    <?= Yii::t('app', 'Help'); ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.indeedjobs.com/helm-squared/" class="nav-link" target="_blank"
                                   rel="noopener">
                                    <?= Yii::t('app', 'Careers'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <div class="copyright text-center text-sm-right text-muted">
                            &copy; Helm Squared Ltd <?= date('Y'); ?>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>

<?php if (!is_null($user->identity)): ?>
    <div id="initial-load-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"
         data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-center">Your account has been successfully upgraded for free!</h4>
                </div>

                <div class="modal-body">
                    <p>We have upgraded your account to use our new payouts service, in partnership with Stripe.</p>

                    <p>This is to make our payout service safer, more secure and more flexible for both you and your
                        customers. It will also allow you
                        to personalise your payout cycles, receive faster automated payouts, and ad hoc payouts whenever
                        you need or want at the touch
                        of a button.</p>

                    <p>By continuing to use Helm Tickets, you are agreeing to <a href="https://stripe.com/gb/legal"
                                                                                 target="_blank"
                                                                                 rel="noopener noreferrer">Stripe's
                            Terms of Service</a> and the <a
                                href="https://stripe.com/connect-account/legal" target="_blank"
                                rel="noopener noreferrer">Stripe Connected Account
                            Agreement</a></p>

                    <p>You may also need to verify your account with some additional details.</p>
                </div>

                <div class="modal-footer">
                    <button id="accept-stripe-terms" class="btn btn-primary btn-fill">Accept Terms &amp; Verify
                        Account
                    </button>
                </div>

            </div>
        </div>
    </div>
<?php endif; ?>
<div id="menu-backdrop" class="modal-backdrop fade d-lg-none"></div>
<?php if (YII_ENV != 'dev'): ?>
<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
    <script type="text/javascript">window.Beacon('init', '20d5a3a4-bd0e-4805-be78-b09ccc14b108')</script>
<?php endif; ?>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
