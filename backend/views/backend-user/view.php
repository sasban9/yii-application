<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BackendUser */
?>
<div class="backend-user-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'status_id',
            'status',
            'email:email',
            'auth_key',
            'verification_key',
            'verification_token',
            'password_hash',
            'password_reset_token',
            'password_hash_old',
            'title',
            'firstname',
            'surname',
            'telephone',
            'est_num_tickets',
            'reg_referrer',
            'stripe_customer_id',
            'referral_code',
            'referral_link',
            'last_login',
            'last_ip_address',
            'alt_event_email:email',
            'last_updated',
            'date_added',
            'mailchimp_token',
            'hubspot_access_token',
            'hubspot_refresh_token',
            'hubspot_token_expiry',
            'stripe_connect_id',
            'payout_country',
            'payout_currency',
            'payout_frequency',
            'locale',
            'timezone',
            'tos_acceptance_ip',
            'tos_acceptance_date',
            'bacs_instructions:ntext',
            'registration_ip',
            'registration_country_from_ip',
            'payout_frequency_updated',
            'allow_change_frequency',
        ],
    ]) ?>

</div>
