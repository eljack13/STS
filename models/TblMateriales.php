<?php

namespace app\models;

use Yii;
use yii\db\Exception;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tbl_materiales".
 *
 * @property int $tbl_materiales_id
 * @property string $tbl_materiales_nombre
 * @property string $tbl_materiales_descripcion
 * @property string $tbl_materiales_codigo
 * @property int $tbl_materiales_cantidad
 * @property int $tbl_materiales_fechaingreso
 * @property string $tbl_materiales_created
 * @property string $tbl_materiales_createdby
 *
 * @property TblMovimientosInventario[] $tblMovimientosInventarios
 */
class TblMateriales extends ActiveRecord
{
    const TIPO_ENTRADA = 'entrada';
    const TIPO_SALIDA = 'salida';
    const TIPO_AJUSTE = 'ajuste';

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
            [['tbl_materiales_nombre', 'tbl_materiales_descripcion', 'tbl_materiales_codigo', 'tbl_materiales_cantidad', 'tbl_materiales_fechaingreso', 'tbl_materiales_created', 'tbl_materiales_createdby'], 'required'],
            [['tbl_materiales_cantidad'], 'integer'],
            [['tbl_materiales_created'], 'safe'],
            [['tbl_materiales_nombre', 'tbl_materiales_descripcion', 'tbl_materiales_codigo'], 'string', 'max' => 100],
            [['tbl_materiales_createdby'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tbl_materiales_id' => 'ID',
            'tbl_materiales_nombre' => 'Nombre',
            'tbl_materiales_descripcion' => 'Descripción',
            'tbl_materiales_codigo' => 'Código',
            'tbl_materiales_cantidad' => 'Cantidad',
            'tbl_materiales_fechaingreso' => 'Fecha de Ingreso',
            'tbl_materiales_created' => 'Fecha de Creación',
            'tbl_materiales_createdby' => 'Creado Por',
        ];
    }

    /**
     * Gets query for [[TblMovimientosInventarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblMovimientosInventarios()
    {
        return $this->hasMany(TblMovimientosInventario::class, ['material_id' => 'tbl_materiales_id']);
    }

    /**
     * Registra un movimiento de inventario y actualiza el stock del material
     * 
     * @param string $tipo Tipo de movimiento (entrada, salida, ajuste)
     * @param float $cantidad Cantidad a mover (positiva para entradas, negativa para salidas)
     * @param string $motivo Motivo del movimiento
     * @param int $usuarioId ID del usuario que realiza el movimiento
     * @return bool Si la operación fue exitosa
     * @throws Exception
     */
    public function registrarMovimiento($tipo, $cantidad, $motivo, $usuarioId)
    {
        $transaction = Yii::$app->db->beginTransaction();
        
        try {
            // Determinar la cantidad ajustada según el tipo de movimiento
            $cantidadMovimiento = $this->calcularCantidadMovimiento($tipo, $cantidad);
            
            // Calcular nueva cantidad en inventario
            $nuevaCantidad = $this->tbl_materiales_cantidad + $cantidadMovimiento;
            
            // Verificar que no resulte en inventario negativo
            if ($nuevaCantidad < 0) {
                throw new Exception('No hay suficiente stock disponible');
            }
            
            // Registrar el movimiento
            $movimiento = new TblMovimientosInventario([
                'material_id' => $this->tbl_materiales_id,
                'tipo' => $tipo,
                'entrada_salida_ajuste' => $cantidadMovimiento,
                'cantidad' => $nuevaCantidad,
                'fecha' => date('Y-m-d H:i:s'),
                'motivo' => $motivo,
                'usuario_id' => $usuarioId,
            ]);
            
            if (!$movimiento->save()) {
                throw new Exception('Error al guardar el movimiento de inventario: ' . json_encode($movimiento->errors));
            }
            
            // Actualizar la cantidad en el material
            $this->tbl_materiales_cantidad = $nuevaCantidad;
            
            if (!$this->save()) {
                throw new Exception('Error al actualizar el stock del material: ' . json_encode($this->errors));
            }
            
            $transaction->commit();
            return true;
            
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * Calcula la cantidad de movimiento según el tipo
     */
    protected function calcularCantidadMovimiento($tipo, $cantidad)
    {
        if ($tipo === self::TIPO_SALIDA) {
            return -abs($cantidad); // Convertir a negativo para salidas
        } elseif ($tipo === self::TIPO_ENTRADA) {
            return abs($cantidad); // Asegurar que sea positivo para entradas
        }
        return $cantidad; // Para ajustes se mantiene el valor original
    }
    
    /**
     * Obtiene el historial de movimientos de este material
     * 
     * @return array Movimientos del material
     */
    public function obtenerHistorialMovimientos()
    {
        return $this->getTblMovimientosInventarios()
            ->orderBy(['fecha' => SORT_DESC])
            ->all();
    }
    
    /**
     * Obtiene el balance de inventario actual (método estático)
     * 
     * @return array Lista de materiales con su stock actual
     */
    public static function obtenerBalanceInventario()
    {
        return self::find()
            ->select(['tbl_materiales_id', 'tbl_materiales_nombre', 'tbl_materiales_codigo', 'tbl_materiales_cantidad'])
            ->orderBy(['tbl_materiales_nombre' => SORT_ASC])
            ->all();
    }
    
    /**
     * Método estático para registrar movimiento (alternativa)
     */
    public static function registrarMovimientoEstatico($materialId, $tipo, $cantidad, $motivo, $usuarioId)
    {
        $material = self::findOne($materialId);
        if (!$material) {
            throw new Exception('Material no encontrado');
        }
        return $material->registrarMovimiento($tipo, $cantidad, $motivo, $usuarioId);
    }
}