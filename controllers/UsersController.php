<?php

namespace app\controllers;

use Yii;
use app\models\UsersModel;
class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRegister()
    {
        $model = new UsersModel();
        return $this->render('register', ['model' => $model]);
    }

    public function actionSignUp()
    {
        $request = Yii::$app->request->post();

        $user = new UsersModel();
        $user->attributes = $request['UsersModel'];
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($user->password);//Hash password before storing to DB
        $user->password_repeat = $user->password;
        $session = Yii::$app->session;

        if($user->validate() && $user->save())
        {
            $session->setFlash('successMessage', 'Registration successful');
            return $this->redirect(['site/login']);
        }

        $session->setFlash('errorMessages', $user->getErrors());
        return $this->redirect(['users/register']);
    }

}
