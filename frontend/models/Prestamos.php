<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "prestamos".
 *
 * @property int $id
 * @property int $noControlAlumno
 * @property string $nombreAlumno
 * @property string $materiaID
 * @property int $docenteID
 * @property string $periodo
 * @property string|null $fecha
 * @property string|null $observaciones
 * @property string $entregaNombre
 *
 * @property Materiales[] $materiales
 */
class Prestamos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prestamos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['noControlAlumno', 'nombreAlumno', 'docenteID', 'periodo', 'entregaNombre'], 'required'],
            [['noControlAlumno', 'docenteID','materiaID'], 'integer'],
            [['fecha'], 'safe'],
            [['observaciones'], 'string'],
            [['nombreAlumno', 'materiaID'], 'string', 'max' => 50],
            [['periodo', 'entregaNombre'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID del alumno',
            'noControlAlumno' => 'No. control del alumno',
            'nombreAlumno' => 'Nombre del alumno',
            'materiaID' => 'Materia',
            'docenteID' => 'Docente',
            'periodo' => 'Periodo',
            'fecha' => 'Fecha',
            'observaciones' => 'Observaciones',
            'entregaNombre' => 'Nombre de quien entrega material',
        ];
    }

    /**
     * Gets query for [[Materiales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMateriales()
    {
        return $this->hasMany(Materiales::className(), ['prest_id' => 'id']);
    }

    public function getDocentenom()

    {

        return $this->hasOne(Docentes::className(), ['docenteID' => 'docenteID']);

    }

    public function getMaterianom()

    {

        return $this->hasOne(Materias::className(), ['materiaID' => 'materiaID']);

    }


}
