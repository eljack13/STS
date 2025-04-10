<?php

namespace app\services;

use app\models\TblMateriales;
use app\models\TblMovimientosInventario;
use Yii;
use yii\base\Exception;

class InventarioService extends Component
{ 
    const TIPO_ENTRADA = 'entrada';
    const TIPO_SALIDA = 'salida';
    const TIPO_AJUSTE = 'ajuste';
    
    /**
     * Registra un movimiento de inventario y actualiza el stock del material
     * 
     * @param int $materialId ID del material
     * @param string $tipo Tipo de movimiento (entrada, salida, ajuste)
     * @param float $cantidad Cantidad a mover (positiva para entradas, negativa para salidas)
     * @param string $motivo Motivo del movimiento
     * @param int $usuarioId ID del usuario que realiza el movimiento
     * @return bool Si la operación fue exitosa
     * @throws Exception
     */
    public function registrarMovimiento($materialId, $tipo, $cantidad, $motivo, $usuarioId)
    {
        $transaction = Yii::$app->db->beginTransaction();
        
        try {
            // Obtener el material
            $material = TblMateriales::findOne($materialId);
            
            if (!$material) {
                throw new Exception('Material no encontrado');
            }
            
            // Determinar la cantidad ajustada según el tipo de movimiento
            $cantidadMovimiento = $cantidad;
            if ($tipo === self::TIPO_SALIDA) {
                $cantidadMovimiento = -abs($cantidad); // Convertir a negativo para salidas
            } elseif ($tipo === self::TIPO_ENTRADA) {
                $cantidadMovimiento = abs($cantidad); // Asegurar que sea positivo para entradas
            }
            
            // Calcular nueva cantidad en inventario
            $nuevaCantidad = $material->tbl_materiales_cantidad + $cantidadMovimiento;
            
            // Verificar que no resulte en inventario negativo
            if ($nuevaCantidad < 0) {
                throw new Exception('No hay suficiente stock disponible');
            }
            
            // Registrar el movimiento
            $movimiento = new TblMovimientosInventario();
            $movimiento->material_id = $materialId;
            $movimiento->tipo = $tipo;
            $movimiento->entrada_salida_ajuste = $cantidadMovimiento;
            $movimiento->cantidad = $nuevaCantidad; // Cantidad final después del movimiento
            $movimiento->fecha = date('Y-m-d H:i:s');
            $movimiento->motivo = $motivo;
            $movimiento->usuario_id = $usuarioId;
            
            if (!$movimiento->save()) {
                throw new Exception('Error al guardar el movimiento de inventario');
            }
            
            // Actualizar la cantidad en el material
            $material->tbl_materiales_cantidad = $nuevaCantidad;
            
            if (!$material->save()) {
                throw new Exception('Error al actualizar el stock del material');
            }
            
            $transaction->commit();
            return true;
            
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
    
    /**
     * Obtiene el historial de movimientos de un material
     * 
     * @param int $materialId ID del material
     * @return array Movimientos del material
     */
    public function obtenerHistorialMovimientos($materialId)
    {
        return TblMovimientosInventario::find()
            ->where(['material_id' => $materialId])
            ->orderBy(['fecha' => SORT_DESC])
            ->all();
    }
    
    /**
     * Obtiene el balance de inventario actual
     * 
     * @return array Lista de materiales con su stock actual
     */
    public function obtenerBalanceInventario()
    {
        return TblMateriales::find()
            ->select(['tbl_materiales_id', 'tbl_materiales_nombre', 'tbl_materiales_codigo', 'tbl_materiales_cantidad'])
            ->orderBy(['tbl_materiales_nombre' => SORT_ASC])
            ->all();
    }
}