<?php
namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\User;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $request = Yii::$app->request->post();
        $user = User::findByUsername($request['username']);

        if ($user && $user->validatePassword($request['password'])) {
            $token = $user->generateJwtToken();
            return ['token' => $token];
        } else {
            return ['error' => 'Invalid username or password'];
        }
    }
}