<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "alumnos".
 *
 * @property int $noControl
 * @property string $alumnoNombre
 * @property string $alumnoCarreraNombre
 *
 * @property Prestamos[] $prestamos
 */
class Alumnos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alumnos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['noControl', 'alumnoNombre', 'alumnoCarreraNombre'], 'required'],
            [['noControl'], 'integer'],
            [['alumnoNombre'], 'string', 'max' => 50],
            [['alumnoCarreraNombre'], 'string', 'max' => 60],
            [['noControl'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'noControl' => 'Numero de Control',
            'alumnoNombre' => 'Nombre del Alumno',
            'alumnoCarreraNombre' => 'Carrera del alumno',
        ];
    }

    /**
     * Gets query for [[Prestamos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamos::className(), ['noControlAlumno' => 'noControl']);
    }
}
