<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Tese;
use common\models\search\TeseSearch;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class TeseController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new TeseSearch;
        $searchModel->order = ['data_publicacao' => SORT_DESC];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionView($id)
    {
        
        $model = $this->findModel($id); 
        
        return $this->render('view',[
            'model' => $model
            
        ]);
    }
    
    protected function findModel($id)
    {
        $model = Tese::find()->where(['thesis_id' => $id ])->one();
        if ($model === null){
            throw new HttpException(404, "Tese não encontrado");
        } 
        return $model;
    }
    
}
