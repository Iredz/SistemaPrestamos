<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "devoluciones".
 *
 * @property int $id
 * @property int $alumnoNoControl
 * @property string $alumnoNombre
 * @property string $recibeNombre
 * @property string|null $observaciones
 *
 * @property MaterialDevuelto[] $materialDevueltos
 */
class Devoluciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'devoluciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnoNoControl', 'alumnoNombre', 'recibeNombre'], 'required'],
            [['alumnoNoControl'], 'integer'],
            [['observaciones'], 'string'],
            [['alumnoNombre'], 'string', 'max' => 50],
            [['recibeNombre'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alumnoNoControl' => 'Alumno No Control',
            'alumnoNombre' => 'Alumno Nombre',
            'recibeNombre' => 'Recibe Nombre',
            'observaciones' => 'Observaciones',
        ];
    }

    /**
     * Gets query for [[MaterialDevueltos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialDevueltos()
    {
        return $this->hasMany(MaterialDevuelto::className(), ['dev_id' => 'id']);
    }
}
