<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_materiales".
 *
 * @property int $tbl_materiales_id
 * @property string $tbl_materiales_nombre
 * @property string $tbl_materiales_descripcion
 * @property int $tbl_materiales_cantidad
 * @property int $tbl_materiales_fechaingreso
 * @property string $tbl_materiales_created
 * @property string $tbl_materiales_createdby
 */
class TblMateriales extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_materiales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tbl_materiales_nombre', 'tbl_materiales_descripcion', 'tbl_materiales_cantidad', 'tbl_materiales_fechaingreso', 'tbl_materiales_created', 'tbl_materiales_createdby'], 'required'],
            [['tbl_materiales_cantidad', 'tbl_materiales_fechaingreso'], 'integer'],
            [['tbl_materiales_created', 'tbl_materiales_createdby'], 'safe'],
            [['tbl_materiales_nombre', 'tbl_materiales_descripcion'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tbl_materiales_id' => 'Tbl Materiales ID nano esz puto ',
            'tbl_materiales_nombre' => 'Tbl Materiales Nombre',
            'tbl_materiales_descripcion' => 'Tbl Materiales Descripcion',
            'tbl_materiales_codigo' => 'Tbl Materiales Codigo',
            'tbl_materiales_cantidad' => 'Tbl Materiales Cantidad',
            'tbl_materiales_fechaingreso' => 'Tbl Materiales Fechaingreso',
            'tbl_materiales_created' => 'Tbl Materiales Created',
            'tbl_materiales_createdby' => 'Tbl Materiales Createdby',
        ];
    }

}
