<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property int $status_id
 * @property int $status
 * @property string $email
 * @property string|null $auth_key
 * @property string|null $verification_key
 * @property string|null $verification_token
 * @property string|null $password_hash
 * @property string|null $password_reset_token
 * @property string|null $password_hash_old
 * @property string|null $title
 * @property string $firstname
 * @property string $surname
 * @property string|null $telephone
 * @property string|null $est_num_tickets
 * @property string|null $reg_referrer
 * @property string|null $stripe_customer_id
 * @property string|null $referral_code
 * @property string|null $referral_link
 * @property string|null $last_login
 * @property string|null $last_ip_address
 * @property string|null $alt_event_email
 * @property string|null $last_updated
 * @property string $date_added
 * @property string|null $mailchimp_token
 * @property string|null $hubspot_access_token
 * @property string|null $hubspot_refresh_token
 * @property string|null $hubspot_token_expiry
 * @property string|null $stripe_connect_id
 * @property string|null $payout_country
 * @property string|null $payout_currency
 * @property string|null $payout_frequency
 * @property string|null $locale
 * @property string|null $timezone
 * @property string|null $tos_acceptance_ip
 * @property string|null $tos_acceptance_date
 * @property string|null $bacs_instructions
 * @property string|null $registration_ip
 * @property string|null $registration_country_from_ip
 * @property string|null $payout_frequency_updated
 * @property int|null $allow_change_frequency
 *
 * @property ModerationWhitelist[] $moderationWhitelists
 * @property OrderTransfers[] $orderTransfers
 * @property Payout[] $payouts
 * @property ReportTemplates[] $reportTemplates
 * @property StatementAdjustments[] $statementAdjustments
 * @property TaxRates[] $taxRates
 * @property TopUp[] $topUps
 */
class BackendUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_id', 'status', 'allow_change_frequency'], 'integer'],
            [['email', 'firstname', 'surname'], 'required'],
            [['last_login', 'last_updated', 'date_added', 'hubspot_token_expiry', 'tos_acceptance_date', 'payout_frequency_updated'], 'safe'],
            [['bacs_instructions'], 'string'],
            [['email', 'password_hash', 'password_reset_token', 'password_hash_old', 'est_num_tickets', 'alt_event_email', 'mailchimp_token', 'hubspot_access_token', 'hubspot_refresh_token', 'locale', 'timezone'], 'string', 'max' => 255],
            [['auth_key', 'title'], 'string', 'max' => 45],
            [['verification_key', 'verification_token'], 'string', 'max' => 16],
            [['firstname', 'surname'], 'string', 'max' => 100],
            [['telephone', 'last_ip_address', 'tos_acceptance_ip', 'registration_ip'], 'string', 'max' => 50],
            [['reg_referrer'], 'string', 'max' => 80],
            [['stripe_customer_id', 'referral_link', 'stripe_connect_id'], 'string', 'max' => 60],
            [['referral_code'], 'string', 'max' => 10],
            [['payout_country', 'payout_currency', 'registration_country_from_ip'], 'string', 'max' => 5],
            [['payout_frequency'], 'string', 'max' => 20],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status_id' => Yii::t('app', 'Status ID'),
            'status' => Yii::t('app', 'Status'),
            'email' => Yii::t('app', 'Email'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'verification_key' => Yii::t('app', 'Verification Key'),
            'verification_token' => Yii::t('app', 'Verification Token'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'password_hash_old' => Yii::t('app', 'Password Hash Old'),
            'title' => Yii::t('app', 'Title'),
            'firstname' => Yii::t('app', 'Firstname'),
            'surname' => Yii::t('app', 'Surname'),
            'telephone' => Yii::t('app', 'Telephone'),
            'est_num_tickets' => Yii::t('app', 'Est Num Tickets'),
            'reg_referrer' => Yii::t('app', 'Reg Referrer'),
            'stripe_customer_id' => Yii::t('app', 'Stripe Customer ID'),
            'referral_code' => Yii::t('app', 'Referral Code'),
            'referral_link' => Yii::t('app', 'Referral Link'),
            'last_login' => Yii::t('app', 'Last Login'),
            'last_ip_address' => Yii::t('app', 'Last Ip Address'),
            'alt_event_email' => Yii::t('app', 'Alt Event Email'),
            'last_updated' => Yii::t('app', 'Last Updated'),
            'date_added' => Yii::t('app', 'Date Added'),
            'mailchimp_token' => Yii::t('app', 'Mailchimp Token'),
            'hubspot_access_token' => Yii::t('app', 'Hubspot Access Token'),
            'hubspot_refresh_token' => Yii::t('app', 'Hubspot Refresh Token'),
            'hubspot_token_expiry' => Yii::t('app', 'Hubspot Token Expiry'),
            'stripe_connect_id' => Yii::t('app', 'Stripe Connect ID'),
            'payout_country' => Yii::t('app', 'Payout Country'),
            'payout_currency' => Yii::t('app', 'Payout Currency'),
            'payout_frequency' => Yii::t('app', 'Payout Frequency'),
            'locale' => Yii::t('app', 'Locale'),
            'timezone' => Yii::t('app', 'Timezone'),
            'tos_acceptance_ip' => Yii::t('app', 'Tos Acceptance Ip'),
            'tos_acceptance_date' => Yii::t('app', 'Tos Acceptance Date'),
            'bacs_instructions' => Yii::t('app', 'Bacs Instructions'),
            'registration_ip' => Yii::t('app', 'Registration Ip'),
            'registration_country_from_ip' => Yii::t('app', 'Registration Country From Ip'),
            'payout_frequency_updated' => Yii::t('app', 'Payout Frequency Updated'),
            'allow_change_frequency' => Yii::t('app', 'Allow Change Frequency'),
        ];
    }

    /**
     * Gets query for [[ModerationWhitelists]].
     *
     * @return \yii\db\ActiveQuery|ModerationWhitelistQuery
     */
    public function getModerationWhitelists()
    {
        return $this->hasMany(ModerationWhitelist::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[OrderTransfers]].
     *
     * @return \yii\db\ActiveQuery|OrderTransfersQuery
     */
    public function getOrderTransfers()
    {
        return $this->hasMany(OrderTransfers::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Payouts]].
     *
     * @return \yii\db\ActiveQuery|PayoutQuery
     */
    public function getPayouts()
    {
        return $this->hasMany(Payout::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[ReportTemplates]].
     *
     * @return \yii\db\ActiveQuery|ReportTemplatesQuery
     */
    public function getReportTemplates()
    {
        return $this->hasMany(ReportTemplates::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[StatementAdjustments]].
     *
     * @return \yii\db\ActiveQuery|StatementAdjustmentsQuery
     */
    public function getStatementAdjustments()
    {
        return $this->hasMany(StatementAdjustments::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[TaxRates]].
     *
     * @return \yii\db\ActiveQuery|TaxRatesQuery
     */
    public function getTaxRates()
    {
        return $this->hasMany(TaxRates::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[TopUps]].
     *
     * @return \yii\db\ActiveQuery|TopUpQuery
     */
    public function getTopUps()
    {
        return $this->hasMany(TopUp::className(), ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return BackendUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BackendUserQuery(get_called_class());
    }
}
