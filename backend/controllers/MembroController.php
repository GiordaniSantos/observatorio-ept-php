<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use dynamikaweb\layout\ChangeLayout;
use common\models\Membro;
use common\models\User;
use common\models\search\MembroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MembroController implements the CRUD actions for Membro model.
 */
class MembroController extends Controller
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
                        'controllers' => ['membro'],
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
     * Lists all Membro models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MembroSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Membro model.
     * @param int $member_id Member ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($member_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($member_id),
        ]);
    }

    /**
     * Creates a new Membro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Membro();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'member_id' => $model->member_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Membro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $member_id Member ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($member_id)
    {
        $model = $this->findModel($member_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'member_id' => $model->member_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Membro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $member_id Member ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($member_id)
    {
        $this->findModel($member_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Membro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $member_id Member ID
     * @return Membro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($member_id)
    {
        if (($model = Membro::findOne(['member_id' => $member_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
