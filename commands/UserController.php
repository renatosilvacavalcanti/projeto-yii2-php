<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\User;

class UserController extends Controller
{
    public function actionCreate($username, $password, $name)
    {
        $user = new User();
        $user->username = $username;
        $user->name = $name;
        $user->setPassword($password);
        $user->generateAuthKey();
        if ($user->save()) {
            $token = $user->generateJwtToken();
            echo "User created successfully.\n";
            echo "JWT Token: $token\n";
        } else {
            echo "Failed to create user.\n";
            foreach ($user->errors as $error) {
                echo "$error\n";
            }
        }
    }
}

