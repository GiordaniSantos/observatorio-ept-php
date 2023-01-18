<?php

namespace backend\controllers;

use common\models\Noticia;
use common\models\search\NoticiaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NoticiaController implements the CRUD actions for Noticia model.
 */
class NoticiaController extends Controller
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
     * Lists all Noticia models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NoticiaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Noticia model.
     * @param int $news_id News ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($news_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($news_id),
        ]);
    }

    /**
     * Creates a new Noticia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Noticia();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'news_id' => $model->news_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Noticia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $news_id News ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($news_id)
    {
        $model = $this->findModel($news_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'news_id' => $model->news_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Noticia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $news_id News ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($news_id)
    {
        $this->findModel($news_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Noticia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $news_id News ID
     * @return Noticia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($news_id)
    {
        if (($model = Noticia::findOne(['news_id' => $news_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
