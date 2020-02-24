<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "docentes".
 *
 * @property int $docenteID
 * @property string $docenteNombre
 * @property string $docenteCarreraNombre
 */
class Docentes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'docentes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['docenteNombre', 'docenteCarreraNombre'], 'required'],
            [['docenteNombre'], 'string', 'max' => 50],
            [['docenteCarreraNombre'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'docenteID' => 'ID del Docente',
            'docenteNombre' => 'Nombre del Docente',
            'docenteCarreraNombre' => 'Carrera del Docente',
        ];
    }
}
