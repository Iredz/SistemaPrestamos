<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Inventario;
use frontend\models\InventarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\web\Response;

/**
 * InventarioController implements the CRUD actions for Inventario model.
 */
class InventarioController extends Controller
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
     * Lists all Inventario models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('modificarInventario'))
        {
        $searchModel = new InventarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        }
        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }

    /**
     * Displays a single Inventario model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('modificarInventario'))
        {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

        }
        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }

    /**
     * Creates a new Inventario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('modificarInventario'))
        {
        $model = new Inventario();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->matID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);

        }
        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }

    /**
     * Updates an existing Inventario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('modificarInventario'))
        {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->matID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

        }
        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }

    /**
     * Deletes an existing Inventario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('modificarInventario'))
        {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);

        }
        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }

    /**
     * Finds the Inventario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inventario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inventario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Favor de Iniciar Sesión');
    }

    public function actionGetNombreMaterial ($matID)
    {
        // Busca los registros del material con el ID que iguale
        //  al ingresado en el campo "ID del Material" en la tabla Inventario
        $inventario = Inventario::findOne($matID);
        // Codifica en formato JSON al encontrarlo
        echo Json::encode($inventario);
    }
}



