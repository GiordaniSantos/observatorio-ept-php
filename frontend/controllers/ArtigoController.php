<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Artigo;
use common\models\search\ArtigoSearch;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class ArtigoController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new ArtigoSearch;
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
        $model = Artigo::find()->where(['article_id' => $id ])->one();
        if ($model === null){
            throw new HttpException(404, "Artigo não encontrado");
        } 
        return $model;
    }
    
}
