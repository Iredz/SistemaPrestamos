<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "material_devuelto".
 *
 * @property int $id
 * @property int $matID
 * @property string $materialNombre
 * @property int $dev_id
 *
 * @property Devoluciones $dev
 */
class MaterialDevuelto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material_devuelto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matID', 'materialNombre'], 'required'],
            [['matID', 'dev_id'], 'integer'],
            [['materialNombre'], 'string', 'max' => 50],
            [['dev_id'], 'exist', 'skipOnError' => true, 'targetClass' => Devoluciones::className(), 'targetAttribute' => ['dev_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'matID' => 'ID del Material',
            'materialNombre' => 'Nombre del Material',
            'dev_id' => 'Dev ID',
        ];
    }

    /**
     * Gets query for [[Dev]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDev()
    {
        return $this->hasOne(Devoluciones::className(), ['id' => 'dev_id']);
    }
}
