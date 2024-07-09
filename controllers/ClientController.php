<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\Client;
use app\components\JwtAuth;

class ClientController extends ActiveController
{
    public $modelClass = 'app\models\Client';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // Adiciona a autenticação JWT
        $behaviors['authenticator'] = [
            'class' => JwtAuth::class,
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        // Desabilita a ação "index" padrão
        unset($actions['index']);
        return $actions;
    }

    // Implementa a ação "index" para adicionar paginação
    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => Client::find(),
            'pagination' => [
                'pageSize' => 10, // Define o número de itens por página
            ],
        ]);
    }
}
