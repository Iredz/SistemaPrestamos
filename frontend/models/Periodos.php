<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "periodos".
 *
 * @property int $periodoID
 * @property string $periodoNombre
 */
class Periodos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'periodos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['periodoNombre'], 'required'],
            [['periodoNombre'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'periodoID' => 'Periodo ID',
            'periodoNombre' => 'Periodo Nombre',
        ];
    }
}
