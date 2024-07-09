<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Client extends ActiveRecord
{
    public static function tableName()
    {
        return 'client';
    }

    public function rules()
    {
        return [
            [['name', 'cpf', 'cep', 'logradouro', 'numero', 'cidade', 'estado', 'sexo'], 'required'],
            ['cpf', 'string', 'length' => [11, 11]],
            ['cpf', 'unique'],
            ['cpf', 'match', 'pattern' => '/^\d{11}$/'],
            ['cep', 'string', 'length' => [8, 8]],
            ['cep', 'match', 'pattern' => '/^\d{8}$/'],
            ['estado', 'string', 'length' => [2, 2]],
            ['sexo', 'in', 'range' => ['masculino', 'feminino']],
            ['photo', 'string'],
            [['complemento'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Nome',
            'cpf' => 'CPF',
            'cep' => 'CEP',
            'logradouro' => 'Logradouro',
            'numero' => 'Número',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'sexo' => 'Sexo',
            'photo' => 'Foto',
            'complemento' => 'Complemento',
        ];
    }
}
