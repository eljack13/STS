<?php

namespace app\controllers;

use app\models\TblMateriales;
use app\models\TblMaterialesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MaterialesController implements the CRUD actions for TblMateriales model.
 */
class MaterialesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all TblMateriales models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TblMaterialesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblMateriales model.
     * @param int $tbl_materiales_id Tbl Materiales ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($tbl_materiales_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($tbl_materiales_id),
        ]);
    }

    /**
     * Creates a new TblMateriales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TblMateriales();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'tbl_materiales_id' => $model->tbl_materiales_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TblMateriales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $tbl_materiales_id Tbl Materiales ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($tbl_materiales_id)
    {
        $model = $this->findModel($tbl_materiales_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tbl_materiales_id' => $model->tbl_materiales_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TblMateriales model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $tbl_materiales_id Tbl Materiales ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($tbl_materiales_id)
    {
        $this->findModel($tbl_materiales_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblMateriales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $tbl_materiales_id Tbl Materiales ID
     * @return TblMateriales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tbl_materiales_id)
    {
        if (($model = TblMateriales::findOne(['tbl_materiales_id' => $tbl_materiales_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
