<?php
namespace app\components;

use Yii;
use yii\filters\auth\AuthMethod;
use Firebase\JWT\JWT;
use yii\web\UnauthorizedHttpException;
use app\models\User;

class JwtAuth extends AuthMethod
{
    public function authenticate($user, $request, $response)
    {
        $authHeader = $request->getHeaders()->get('Authorization');
        if ($authHeader !== null && preg_match('/^Bearer\s+(.*?)$/', $authHeader, $matches)) {
            $token = $matches[1];
            try {
                $decoded = JWT::decode($token, Yii::$app->params['jwtSecretKey'], ['HS256']);
                $identity = User::findIdentity($decoded->id);
                if ($identity === null) {
                    throw new UnauthorizedHttpException('Your request was made with invalid credentials.');
                }
                return $identity;
            } catch (\Exception $e) {
                throw new UnauthorizedHttpException('Your request was made with invalid credentials.');
            }
        }
        return null;
    }
}
