<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use dynamikaweb\layout\ChangeLayout;
use common\models\Tese;
use common\models\search\TeseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeseController implements the CRUD actions for Tese model.
 */
class TeseController extends Controller
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
                        'controllers' => ['tese'],
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
     * Lists all Tese models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TeseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tese model.
     * @param int $thesis_id Thesis ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($thesis_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($thesis_id),
        ]);
    }

    /**
     * Creates a new Tese model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tese();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'thesis_id' => $model->thesis_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tese model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $thesis_id Thesis ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($thesis_id)
    {
        $model = $this->findModel($thesis_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'thesis_id' => $model->thesis_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tese model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $thesis_id Thesis ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($thesis_id)
    {
        $this->findModel($thesis_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tese model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $thesis_id Thesis ID
     * @return Tese the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($thesis_id)
    {
        if (($model = Tese::findOne(['thesis_id' => $thesis_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
