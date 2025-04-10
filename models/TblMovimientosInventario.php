<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_movimientos_inventario".
 *
 * @property int $id
 * @property int $material_id
 * @property string $tipo
 * @property float $entrada_salida_ajuste
 * @property float $cantidad
 * @property string $fecha
 * @property string $motivo
 * @property int $usuario_id
 *
 * @property TblMateriales $material
 * @property User $usuario
 */
class TblMovimientosInventario extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'tbl_movimientos_inventario';
    }

    public function rules()
    {
        return [
            [['material_id', 'tipo', 'entrada_salida_ajuste', 'motivo'], 'required'],
            [['material_id', 'usuario_id'], 'integer'],
            [['entrada_salida_ajuste', 'cantidad'], 'number'],
            [['fecha'], 'safe'],
            [['motivo'], 'string'],
            [['tipo'], 'string', 'max' => 20],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblMateriales::className(), 'targetAttribute' => ['material_id' => 'tbl_materiales_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'material_id' => 'Material',
            'tipo' => 'Tipo de Movimiento',
            'entrada_salida_ajuste' => 'Cantidad',
            'cantidad' => 'Stock después',
            'fecha' => 'Fecha',
            'motivo' => 'Motivo',
            'usuario_id' => 'Usuario',
        ];
    }

    public function getMaterial()
    {
        return $this->hasOne(TblMateriales::className(), ['tbl_materiales_id' => 'material_id']);
    }

    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->fecha = date('Y-m-d H:i:s');
                $this->usuario_id = Yii::$app->user->id;
            }
            return true;
        }
        return false;
    }
}