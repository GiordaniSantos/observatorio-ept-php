<?php

namespace backend\controllers;

use common\models\Projeto;
use common\models\search\ProjetoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjetoController implements the CRUD actions for Projeto model.
 */
class ProjetoController extends Controller
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
     * Lists all Projeto models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProjetoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Projeto model.
     * @param int $project_id Project ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($project_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($project_id),
        ]);
    }

    /**
     * Creates a new Projeto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Projeto();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'project_id' => $model->project_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Projeto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $project_id Project ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($project_id)
    {
        $model = $this->findModel($project_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'project_id' => $model->project_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Projeto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $project_id Project ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($project_id)
    {
        $this->findModel($project_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Projeto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $project_id Project ID
     * @return Projeto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($project_id)
    {
        if (($model = Projeto::findOne(['project_id' => $project_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
