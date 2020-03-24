<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "empleados".
 *
 * @property int $empleadoID
 * @property string|null $empleadoNombre
 */
class Empleados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empleados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['empleadoNombre'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'empleadoID' => 'ID de Empleado',
            'empleadoNombre' => 'Nombre de Empleado',
        ];
    }
}
