<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "inventario".
 *
 * @property int $matID
 * @property string|null $descrMat
 * @property string|null $marca
 * @property string|null $modelo
 * @property string|null $serie
 * @property string|null $noInventario
 * @property string|null $estatus
 *
 * @property Bajas[] $bajas
 * @property Devoluciones[] $devoluciones
 */
class Inventario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descrMat'], 'string', 'max' => 50],
            [['marca'], 'string', 'max' => 30],
            [['modelo'], 'string', 'max' => 15],
            [['serie', 'noInventario'], 'string', 'max' => 25],
            [['estatus'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'matID' => 'ID del Material',
            'descrMat' => 'Descripción del Material',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'serie' => 'Serie',
            'noInventario' => 'No de Inventario',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Bajas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBajas()
    {
        return $this->hasMany(Bajas::className(), ['matID' => 'matID']);
    }

    /**
     * Gets query for [[Devoluciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevoluciones()
    {
        return $this->hasMany(Devoluciones::className(), ['matID' => 'matID']);
    }
}
