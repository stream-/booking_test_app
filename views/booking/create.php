<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BookingData $model */

$this->title = Yii::t('app', 'Book hall');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Booking Datas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'halls' => $halls,
        'hall' => $hall,
        'user' => $user
    ]) ?>

</div>
