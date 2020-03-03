<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "materiales".
 *
 * @property int $id
 * @property int $matID
 * @property string $materialNombre
 * @property int $prest_id
 *
 * @property Prestamos $prest
 */
class Materiales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materiales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matID', 'materialNombre'], 'required'],
            [['matID', 'prest_id'], 'integer'],
            [['materialNombre'], 'string', 'max' => 50],
            [['prest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prestamos::className(), 'targetAttribute' => ['prest_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'matID' => 'ID del material',
            'materialNombre' => 'Nombre del Material',
            'prest_id' => 'Prest ID',
        ];
    }

    /**
     * Gets query for [[Prest]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrest()
    {
        return $this->hasOne(Prestamos::className(), ['id' => 'prest_id']);
    }
}
