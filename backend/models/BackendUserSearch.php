<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BackendUser;

/**
 * BackendUserSearch represents the model behind the search form about `backend\models\BackendUser`.
 */
class BackendUserSearch extends BackendUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_id', 'status'], 'integer'],
            [['email', 'auth_key', 'verification_key', 'verification_token', 'password_hash', 'password_reset_token', 'password_hash_old', 'title', 'firstname', 'surname', 'telephone', 'est_num_tickets', 'reg_referrer', 'stripe_customer_id', 'referral_code', 'referral_link', 'last_login', 'last_ip_address', 'alt_event_email', 'last_updated', 'date_added', 'mailchimp_token', 'hubspot_access_token', 'hubspot_refresh_token', 'hubspot_token_expiry', 'stripe_connect_id', 'payout_country', 'payout_currency', 'payout_frequency', 'locale', 'timezone', 'tos_acceptance_ip', 'tos_acceptance_date', 'bacs_instructions', 'registration_ip', 'registration_country_from_ip', 'payout_frequency_updated', 'allow_change_frequency'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = BackendUser::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status_id' => $this->status_id,
            'status' => $this->status,
            'last_login' => $this->last_login,
            'last_updated' => $this->last_updated,
            'date_added' => $this->date_added,
            'hubspot_token_expiry' => $this->hubspot_token_expiry,
            'tos_acceptance_date' => $this->tos_acceptance_date,
            'payout_frequency_updated' => $this->payout_frequency_updated,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'verification_key', $this->verification_key])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'password_hash_old', $this->password_hash_old])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'est_num_tickets', $this->est_num_tickets])
            ->andFilterWhere(['like', 'reg_referrer', $this->reg_referrer])
            ->andFilterWhere(['like', 'stripe_customer_id', $this->stripe_customer_id])
            ->andFilterWhere(['like', 'referral_code', $this->referral_code])
            ->andFilterWhere(['like', 'referral_link', $this->referral_link])
            ->andFilterWhere(['like', 'last_ip_address', $this->last_ip_address])
            ->andFilterWhere(['like', 'alt_event_email', $this->alt_event_email])
            ->andFilterWhere(['like', 'mailchimp_token', $this->mailchimp_token])
            ->andFilterWhere(['like', 'hubspot_access_token', $this->hubspot_access_token])
            ->andFilterWhere(['like', 'hubspot_refresh_token', $this->hubspot_refresh_token])
            ->andFilterWhere(['like', 'stripe_connect_id', $this->stripe_connect_id])
            ->andFilterWhere(['like', 'payout_country', $this->payout_country])
            ->andFilterWhere(['like', 'payout_currency', $this->payout_currency])
            ->andFilterWhere(['like', 'payout_frequency', $this->payout_frequency])
            ->andFilterWhere(['like', 'locale', $this->locale])
            ->andFilterWhere(['like', 'timezone', $this->timezone])
            ->andFilterWhere(['like', 'tos_acceptance_ip', $this->tos_acceptance_ip])
            ->andFilterWhere(['like', 'bacs_instructions', $this->bacs_instructions])
            ->andFilterWhere(['like', 'registration_ip', $this->registration_ip])
            ->andFilterWhere(['like', 'registration_country_from_ip', $this->registration_country_from_ip])
            ->andFilterWhere(['like', 'allow_change_frequency', $this->allow_change_frequency]);

        return $dataProvider;
    }
}
