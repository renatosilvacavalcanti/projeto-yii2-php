<?php
namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%product}}';
    }

    public function rules()
    {
        return [
            [['name', 'preco', 'client_id'], 'required'],
            [['preco'], 'number'],
            [['client_id'], 'integer'],
            ['name', 'string', 'max' => 255],
            ['photo', 'string'],
            ['client_id', 'exist', 'targetClass' => Client::class, 'targetAttribute' => 'id'],
        ];
    }
}
