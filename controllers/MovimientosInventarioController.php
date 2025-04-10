<?php

namespace app\controllers;

use Yii;
use app\models\TblMovimientosInventario;
use app\models\TblMovimientosInventarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\services\InventarioService;
use app\models\TblMateriales;
use app\models\TblMaterialesSearch;
use app\models\TblUsuarios;
use app\models\TblUsuariosSearch;

/**
 * MovimientosInventarioController implementa las acciones CRUD para el modelo TblMovimientosInventario.
 */
class MovimientosInventarioController extends Controller
{
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lista todos los modelos TblMovimientosInventario.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblMovimientosInventarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra un modelo TblMovimientosInventario específico.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException si el modelo no se encuentra
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Registra un nuevo movimiento de inventario usando el servicio.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblMovimientosInventario();
        $materiales = new TblMateriales(); 
        if ($model->load(Yii::$app->request->post())) {
            try {
                // Usamos el servicio para registrar el movimiento en lugar de guardar directamente
                $this->inventarioService->registrarMovimiento(
                    $model->material_id,
                    $model->tipo,
                    $model->entrada_salida_ajuste,
                    $model->motivo,
                    Yii::$app->user->id
                );
                
                Yii::$app->session->setFlash('success', 'Movimiento de inventario registrado correctamente.');
                return $this->redirect(['view', 'id' => $model->id]);
                
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', 'Error: ' . $e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
            'materiales' => $materiales,
        ]);
    }

    /**
     * Actualiza un modelo TblMovimientosInventario existente.
     * Nota: La actualización de movimientos está limitada para evitar inconsistencias en el inventario.
     * Sólo se permite modificar el motivo y detalles que no afecten el stock.
     * 
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException si el modelo no se encuentra
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        // Guardamos los valores originales para saber si cambiaron
        $originalMaterialId = $model->material_id;
        $originalCantidad = $model->entrada_salida_ajuste;
        $originalTipo = $model->tipo;

        if ($model->load(Yii::$app->request->post())) {
            // Verificamos que no se estén modificando datos críticos
            if ($model->material_id != $originalMaterialId || 
                $model->entrada_salida_ajuste != $originalCantidad ||
                $model->tipo != $originalTipo) {
                
                Yii::$app->session->setFlash('error', 
                    'No se permite modificar el material, cantidad o tipo de un movimiento existente. 
                    Si es necesario, cancele este movimiento y cree uno nuevo.');
                    
                return $this->render('update', ['model' => $model]);
            }
            
            // Solo permitimos actualizar campos no críticos
            $model->motivo = Yii::$app->request->post('TblMovimientosInventario')['motivo'];
            
            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Cancela un movimiento de inventario (implementa una reversión)
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException si el modelo no se encuentra
     */
    public function actionCancel($id)
    {
        $model = $this->findModel($id);
        
        try {
            // Crear un movimiento inverso para cancelar este
            $cantidadInversa = -1 * $model->entrada_salida_ajuste;
            $tipoInverso = $model->tipo == 'entrada' ? 'salida' : 
                          ($model->tipo == 'salida' ? 'entrada' : 'ajuste');
            
            $this->inventarioService->registrarMovimiento(
                $model->material_id,
                $tipoInverso,
                $cantidadInversa,
                'Cancelación del movimiento #' . $model->id,
                Yii::$app->user->id
            );
            
            // Marcar el movimiento original como cancelado (puedes añadir un campo 'estado' a tu tabla)
            // $model->estado = 'cancelado';
            // $model->save(false);
            
            Yii::$app->session->setFlash('success', 'Movimiento cancelado correctamente con un movimiento inverso.');
            
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', 'Error al cancelar el movimiento: ' . $e->getMessage());
        }
        
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Encuentra el modelo TblMovimientosInventario basado en su clave primaria.
     * Si el modelo no se encuentra, se lanza una excepción 404 NotFoundHttpException.
     * @param integer $id
     * @return TblMovimientosInventario el modelo cargado
     * @throws NotFoundHttpException si el modelo no se encuentra
     */
    protected function findModel($id)
    {
        if (($model = TblMovimientosInventario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La página solicitada no existe.');
    }
}