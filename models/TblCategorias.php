<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_categorias".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 */
class TblCategorias extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_categorias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'default', 'value' => null],
            [['nombre'], 'required'],
            [['descripcion'], 'string'],
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
        ];
    }

}
