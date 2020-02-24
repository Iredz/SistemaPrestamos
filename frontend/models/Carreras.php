<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "carreras".
 *
 * @property int $carreraID
 * @property string $carreraNombre
 */
class Carreras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carreras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['carreraNombre'], 'required'],
            [['carreraNombre'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'carreraID' => 'Carrera ID',
            'carreraNombre' => 'Carrera Nombre',
        ];
    }
}
