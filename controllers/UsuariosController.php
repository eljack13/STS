<?php

namespace app\controllers;

use app\models\TblUsuarios;
use app\models\TblUsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuariosController implements the CRUD actions for TblUsuarios model.
 */
class UsuariosController extends Controller
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
     * Lists all TblUsuarios models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TblUsuariosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblUsuarios model.
     * @param int $tbl_usuarios_id Tbl Usuarios ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($tbl_usuarios_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($tbl_usuarios_id),
        ]);
    }

    /**
     * Creates a new TblUsuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TblUsuarios();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'tbl_usuarios_id' => $model->tbl_usuarios_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TblUsuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $tbl_usuarios_id Tbl Usuarios ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($tbl_usuarios_id)
    {
        $model = $this->findModel($tbl_usuarios_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tbl_usuarios_id' => $model->tbl_usuarios_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TblUsuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $tbl_usuarios_id Tbl Usuarios ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($tbl_usuarios_id)
    {
        $this->findModel($tbl_usuarios_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblUsuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $tbl_usuarios_id Tbl Usuarios ID
     * @return TblUsuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tbl_usuarios_id)
    {
        if (($model = TblUsuarios::findOne(['tbl_usuarios_id' => $tbl_usuarios_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
