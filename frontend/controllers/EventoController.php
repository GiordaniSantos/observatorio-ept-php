<?php

namespace frontend\controllers;

use Yii;
use common\models\Evento;
use common\models\search\EventoSearch;
use yii\web\NotFoundHttpException;
use yii\web\Controller;

/**
 * Site controller
 */
class EventoController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new EventoSearch;
        $searchModel->order = ['destaque' => SORT_DESC, 'data_inicio' => SORT_ASC];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $eventos = Evento::find()->all();
        $events = [];

        foreach ($eventos as $evento){
            
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $evento->id;
            $Event->title = $evento->titulo;
            $Event->start = date('Y-m-d\Th:i:s\Z',strtotime($evento->data_inicio));
            $Event->end = date('Y-m-d\Th:i:s\Z',strtotime($evento->data_fim));
            $Event->url = '?r=evento%2Fview&id='.$evento->id;
            $events[] = $Event;
        }

        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'events' => $events,
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
        $model = Evento::find()->where(['id' => $id ])->one();
        if ($model === null){
            throw new HttpException(404, "Evento não encontrado");
        } 
        return $model;
    }
    
}
