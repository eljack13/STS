<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ubicaciones".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property int|null $capacidad
 */
class TblUbicaciones extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_ubicaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'capacidad'], 'default', 'value' => null],
            [['nombre'], 'required'],
            [['descripcion'], 'string'],
            [['capacidad'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'capacidad' => 'Capacidad',
        ];
    }

}
