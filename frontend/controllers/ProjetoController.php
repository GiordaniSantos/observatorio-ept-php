<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Projeto;
use common\models\search\ProjetoSearch;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class ProjetoController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new ProjetoSearch;
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
        $model = Projeto::find()->where(['project_id' => $id ])->one();
        if ($model === null){
            throw new HttpException(404, "Projeto não encontrado");
        } 
        return $model;
    }
    
}
