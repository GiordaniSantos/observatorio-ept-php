<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Noticia;
use common\models\search\NoticiaSearch;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class NoticiaController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new NoticiaSearch;
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
        $model = Noticia::find()->where(['news_id' => $id ])->one();
        if ($model === null){
            throw new HttpException(404, "Noticia não encontrado");
        } 
        return $model;
    }
    
}
