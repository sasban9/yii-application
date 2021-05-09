<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Video */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-md-8">
            <?php echo $form->errorSummary($model) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <label for="thumbnail"><?php echo $model->getAttributeLabel('thumbnail'); ?></label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                    <label for="thumbnail" class="custom-file-label">Choose Thumbnail</label>
                </div>
            </div>

            <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <div class="ratio ratio-16x9 mb-3">
                <video class="ratio-item" poster="<?php echo $model->getThumbnailLink() ?>" src="<?php echo $model->getVideoLink() ?>" title="YouTube video" allowfullscreen></video>
            </div>
            
            <div class="mb-3"><div class="text-muted">VIDEO LINK</div><a href="<?php echo $model->getVideoLink() ?>">Open Video</a></div>
            
            <div class="mb-3"><div class="text-muted">VIDEO Name</div><?php echo $model->video_name ?></div>

            <?= $form->field($model, 'status')->dropdownList($model->getStatusLabels()) ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
