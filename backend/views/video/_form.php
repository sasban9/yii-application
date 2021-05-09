<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Video */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <div class="ratio ratio-16x9">
                <iframe src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" title="YouTube video" allowfullscreen></iframe>
            </div>
            
            <div class="mb-3"><div class="text-muted">VIDEO LINK</div><a href="<?php echo $model->getVideoLink() ?>">Open Video</a></div>
            
            <div class="mb-3"><div class="text-muted">VIDEO Name</div><?php echo $model->video_name ?></div>

            <?= $form->field($model, 'status')->textInput() ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
