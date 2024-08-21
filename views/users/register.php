<?php 
 use yii\widgets\ActiveForm;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

    <?php
        $session = Yii::$app->session;
        $errors = $session->getFlash('errorMessages');
        $success = $session->getFlash('successMessage');
        if(isset($errors) && (count($errors) > 0))
        {
            foreach($session->getFlash('errorMessages') as $error)
            {
                echo "<div class='alert alert-danger' role='alert'>$error[0]</div>";
            }
        }

        if(isset($success))
        {
            echo "<div class='alert alert-success' role='alert'>$success</div>";
        }
    ?>

    <h1>Register</h1>

    <?php
    $form = ActiveForm::begin([
        "action" => ["users/sign-up"],
        "method" => "post"
    ]);
    ?>
    <div class="mb-3">
        <?= $form->field($model, 'firstname') ?>
    </div>
    <div class="mb-3">
        <?= $form->field($model, 'middlename') ?>
    </div>
    <div class="mb-3">
        <?= $form->field($model, 'lastname') ?>
    </div>
    <div class="mb-3">
    <?= $form->field($model, 'email') ?>
    </div>
    <div class="mb-3">
        <?= $form->field($model, 'password', ['inputOptions' => ['type' => 'password']]) ?>
    </div>
    <div class="mb-3">
        <?= $form->field($model, 'password_repeat', ['inputOptions' => ['type' => 'password']]) ?>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>

    <?php
    ActiveForm::end();
    ?>
</body>
</html>
