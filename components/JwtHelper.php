<?php
namespace app\components;

use Firebase\JWT\JWT;
use yii\base\Component;

class JwtHelper extends Component
{
    private $key = 'your-secret-key'; // Substitua pela sua chave secreta

    public function generateToken($user)
    {
        $payload = [
            'iss' => 'http://localhost:8080', // O nome do emissor
            'aud' => 'http://localhost:8080', // O nome do público
            'iat' => time(), // O momento em que o token foi emitido
            'nbf' => time(), // O momento antes do qual o token não deve ser aceito
            'exp' => time() + 3600, // O momento em que o token expira (1 hora)
            'data' => [
                'id' => $user->id,
                'username' => $user->username,
            ]
        ];

        return JWT::encode($payload, $this->key);
    }

    public function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, $this->key, ['HS256']);
            return (array)$decoded->data;
        } catch (\Exception $e) {
            return false;
        }
    }
}
