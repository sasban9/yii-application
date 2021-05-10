<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Video */

$this->title = Yii::t('app', 'Create Video');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-create">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="">

        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data', 'class' => 'd-flex flex-column justify-content-center align-items-center']
        ]) ?>

        <?php echo $form->errorSummary($model) ?>

        <div class="upload-icon">
            <i class="fas fa-upload"></i>
        </div>
        <h6 class="m-3">Drag and drop a fiel you want to upload</h6>
        <p class="text-muted">Your video will be private until you publish it</p>

        <button class="btn btn-primary btn-file">
            Select File
            <input type="file" id="videoFile" name="video">
        </button>
        <?php ActiveForm::end() ?>
    </div>

</div>
