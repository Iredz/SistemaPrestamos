<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Devoluciones;
use frontend\models\DevolucionesSearch;
use frontend\models\MaterialDevuelto;
use frontend\models\MaterialDevueltoSearch;
use frontend\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DevolucionesController implements the CRUD actions for Devoluciones model.
 */
class DevolucionesController extends Controller
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
     * Lists all Devoluciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DevolucionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Devoluciones model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

     /*
        $model = $this->findModel($id);
        $modelsMaterialDevuelto=$model->materialdevuelto;

        $searchModel = new MaterialDevueltoSearch();
        $searchModel->dev_id= $model ->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
*/
        return $this->render('view', [
            'model' => $this->findModel($id),
            
        /*
        'model'=>$model,
        'materialdevuelto'=> $materialdevuelto,
        'searchModel'=> $searchModel,
        'dataProvider'=> $dataProvider,
        
        */



        ]);
    }

    /**
     * Creates a new Devoluciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Devoluciones();
        $modelsMaterialDevuelto = [new MaterialDevuelto];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            /* Se hace uso del  modelo "Model.php" , para el manejo
                múltiple de elementos */

            $modelsMaterialDevuelto = Model::createMultiple(MaterialDevuelto::classname());
            Model::loadMultiple($modelsMaterialDevuelto, Yii::$app->request->post());

            // validar los modelos
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsMaterialDevuelto) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsMaterialDevuelto as $modelMaterialDevuelto) {
                            $modelMaterialDevuelto->dev_id = $model->id;
                            if (! ($flag = $modelMaterialDevuelto->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

            }

        }

        return $this->render('create', [
            'model' => $model,
            'modelsMaterialDevuelto' => (empty($modelsMaterialDevuelto)) ? [new MaterialDevuelto] : $modelsMaterialDevuelto
        ]);
    }

    /**
     * Updates an existing Devoluciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Devoluciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Devoluciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Devoluciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Devoluciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
