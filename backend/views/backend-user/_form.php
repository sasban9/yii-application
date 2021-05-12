<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BackendUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="backend-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'verification_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'verification_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash_old')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'est_num_tickets')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reg_referrer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stripe_customer_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referral_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referral_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_login')->textInput() ?>

    <?= $form->field($model, 'last_ip_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alt_event_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_updated')->textInput() ?>

    <?= $form->field($model, 'date_added')->textInput() ?>

    <?= $form->field($model, 'mailchimp_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hubspot_access_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hubspot_refresh_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hubspot_token_expiry')->textInput() ?>

    <?= $form->field($model, 'stripe_connect_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payout_country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payout_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payout_frequency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'locale')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'timezone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tos_acceptance_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tos_acceptance_date')->textInput() ?>

    <?= $form->field($model, 'bacs_instructions')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'registration_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registration_country_from_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payout_frequency_updated')->textInput() ?>

    <?= $form->field($model, 'allow_change_frequency')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
