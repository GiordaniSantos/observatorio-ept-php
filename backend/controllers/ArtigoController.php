<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use dynamikaweb\layout\ChangeLayout;
use common\models\Artigo;
use common\models\search\ArtigoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArtigoController implements the CRUD actions for Artigo model.
 */
class ArtigoController extends Controller
{
     /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'layout' => 'login',
                'class' => ChangeLayout::class,
                'when' => Yii::$app->user->isGuest,
            ],
            [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'controllers' => ['site'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'controllers' => ['artigo'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        // Deny from all:
                        'actions' => ['*'],
                        'allow' => false,
                        'roles' => ['*'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Artigo models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArtigoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Artigo model.
     * @param int $article_id Article ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($article_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($article_id),
        ]);
    }

    /**
     * Creates a new Artigo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Artigo();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'article_id' => $model->article_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Artigo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $article_id Article ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($article_id)
    {
        $model = $this->findModel($article_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'article_id' => $model->article_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Artigo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $article_id Article ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($article_id)
    {
        $this->findModel($article_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Artigo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $article_id Article ID
     * @return Artigo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($article_id)
    {
        if (($model = Artigo::findOne(['article_id' => $article_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
