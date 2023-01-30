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
     * @param int $id Member ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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
                $model->saveFile();
                return $this->redirect(['view', 'id' => $model->id]);
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
     * @param int $id Member ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $model->saveFile();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDeleteArquivo($id)
    {
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(['index']);
        }
        
        $arquivo = \common\models\Arquivo::findOne($id);
        
        if (!$arquivo) {
            return false;
        }
        $arquivo->modelClass = Membro::tableName(); // Necessario para exclusao da pasta do upload
        
        try {
            
            if ($arquivo->delete()) {
                
                return 'success';
            }
        } catch (\Exception $e) {
            $msg = \common\components\helper\Utils::formatDBError($e->getCode());
            Yii::error($e->getMessage());
            return $msg;
        }
        
        return false;
        
    }

    /**
     * Deletes an existing Membro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id Member ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Membro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Member ID
     * @return Membro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Membro::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
