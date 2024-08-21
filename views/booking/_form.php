<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use Yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\BookingData $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="booking-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= 
    //$form->field($model, 'hall_name')->textInput() ;
    $form->field($model, 'hall_name')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($halls, 'id', 'hall_name'),
        'options' => ['placeholder' => 'Find hall ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($user, 'firstname')->textInput() ?>
    <?= $form->field($user, 'middlename')->textInput() ?>
    <?= $form->field($user, 'lastname')->textInput() ?>

    <?= $form->field($model, 'booking_begin')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'booking_end')->textInput(['type' => 'date']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
