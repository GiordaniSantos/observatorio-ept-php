<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Membro;
use common\models\search\MembroSearch;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class MembroController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new MembroSearch;
        $searchModel->order = ['id' => SORT_DESC];
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
        $model = Membro::find()->where(['article_id' => $id ])->one();
        if ($model === null){
            throw new HttpException(404, "Membro não encontrado");
        } 
        return $model;
    }
    
}
