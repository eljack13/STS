<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_procesos".
 *
 * @property int $id
 * @property string $tipo
 * @property string $tabla_afectada
 * @property int $registro_id
 * @property string $descripcion
 * @property int $usuario_id
 * @property string $datetime_fecha
 * @property string|null $valores_anteriores
 * @property string|null $valores_nuevos
 *
 * @property TblUsuarios $usuario
 */
class TblProcesos extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_procesos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valores_anteriores', 'valores_nuevos'], 'default', 'value' => null],
            [['tipo', 'tabla_afectada', 'registro_id', 'descripcion', 'usuario_id'], 'required'],
            [['registro_id', 'usuario_id'], 'integer'],
            [['descripcion', 'valores_anteriores', 'valores_nuevos'], 'string'],
            [['datetime_fecha'], 'safe'],
            [['tipo', 'tabla_afectada'], 'string', 'max' => 50],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblUsuarios::class, 'targetAttribute' => ['usuario_id' => 'tbl_usuarios_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
            'tabla_afectada' => 'Tabla Afectada',
            'registro_id' => 'Registro ID',
            'descripcion' => 'Descripcion',
            'usuario_id' => 'Usuario ID',
            'datetime_fecha' => 'Datetime Fecha',
            'valores_anteriores' => 'Valores Anteriores',
            'valores_nuevos' => 'Valores Nuevos',
        ];
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(TblUsuarios::class, ['tbl_usuarios_id' => 'usuario_id']);
    }

}
