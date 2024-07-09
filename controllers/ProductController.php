<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\data\ActiveDataProvider;
use app\models\Product;

class ProductController extends ActiveController
{
    public $modelClass = 'app\models\Product';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // Adicionar autenticação Bearer
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();

        // Customize the data provider preparation with pagination
        $actions['index']['prepareDataProvider'] = function ($action) {
            $query = Product::find();
            return new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10, // Você pode definir o tamanho da página desejada aqui
                ],
            ]);
        };

        return $actions;
    }
}