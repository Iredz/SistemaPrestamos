<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "materias".
 *
 * @property int $materiaID
 * @property string $materiaNombre
 */
class Materias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['materiaNombre'], 'required'],
            [['materiaNombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'materiaID' => 'Materia ID',
            'materiaNombre' => 'Materia Nombre',
        ];
    }
}
