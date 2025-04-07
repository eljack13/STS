<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_movimientos_inventario".
 *
 * @property int $id
 * @property int $material_id
 * @property string $tipo entrada, salida, ajuste
 * @property float $entrada_salida_ajuste
 * @property float $cantidad Cantidad final después del movimiento
 * @property string $fecha
 * @property string|null $motivo
 * @property int $usuario_id
 *
 * @property TblMateriales $material
 * @property TblUsuarios $usuario
 */
class TblMovimientosInventario extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_movimientos_inventario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['motivo'], 'default', 'value' => null],
            [['material_id', 'tipo', 'entrada_salida_ajuste', 'cantidad', 'fecha', 'usuario_id'], 'required'],
            [['material_id', 'usuario_id'], 'integer'],
            [['entrada_salida_ajuste', 'cantidad'], 'number'],
            [['fecha'], 'safe'],
            [['tipo'], 'string', 'max' => 30],
            [['motivo'], 'string', 'max' => 255],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblMateriales::class, 'targetAttribute' => ['material_id' => 'tbl_materiales_id']],
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
            'material_id' => 'Material ID',
            'tipo' => 'Tipo',
            'entrada_salida_ajuste' => 'Entrada Salida Ajuste',
            'cantidad' => 'Cantidad',
            'fecha' => 'Fecha',
            'motivo' => 'Motivo',
            'usuario_id' => 'Usuario ID',
        ];
    }

    /**
     * Gets query for [[Material]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(TblMateriales::class, ['tbl_materiales_id' => 'material_id']);
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
