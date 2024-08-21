<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Halls $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="halls-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hall_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hall_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'capacity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
