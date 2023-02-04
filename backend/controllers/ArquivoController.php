<?php

namespace backend\controllers;

use kartik\grid\EditableColumnAction;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;
use Exception;
use yii\web\Controller;
use yii\filters\AccessControl;
use dynamikaweb\layout\ChangeLayout;

use common\models\Arquivo;

use Yii;

class ArquivoController extends Controller
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
                        'controllers' => ['arquivo'],
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

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'update' => [                         
                'class' => EditableColumnAction::className(),     
                'modelClass' => Arquivo::className(),   
            ]
        ]);
    }


    /**
     * Deletes an existing Pagina model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $modelClass = null)
    {
        try {
            $model = Arquivo::findOne(['id' => $id]);
            $model->modelClass = $modelClass;

            if (!$model || $model->delete()) {
                if (Yii::$app->request->isAjax) {
                    return true;
                }

                return $this->redirect(['index']);
            }
        } catch (Exception $e) {
            $msg = \common\components\helper\Utils::formatDBError($e->getCode());
            Yii::error($e->getMessage());
            throw new HttpException(409, $msg);
        }
    }
}
