<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "bajas".
 *
 * @property int $bajaID
 * @property int $matID
 * @property string $descrMat
 * @property string $razon
 * @property string $bajaFecha
 *
 * @property Inventario $mat
 */
class Bajas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bajas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matID', 'descrMat', 'razon', 'bajaFecha'], 'required'],
            [['matID'], 'integer'],
            [['razon'], 'string'],
            [['bajaFecha'], 'safe'],
            [['descrMat'], 'string', 'max' => 50],
            [['matID'], 'exist', 'skipOnError' => true, 'targetClass' => Inventario::className(), 'targetAttribute' => ['matID' => 'matID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bajaID' => 'Baja ID',
            'matID' => 'Mat ID',
            'descrMat' => 'Descr Mat',
            'razon' => 'Razon',
            'bajaFecha' => 'Baja Fecha',
        ];
    }

    /**
     * Gets query for [[Mat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMat()
    {
        return $this->hasOne(Inventario::className(), ['matID' => 'matID']);
    }
}
