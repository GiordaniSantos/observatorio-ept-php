<?php

use common\models\Noticia;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\NoticiaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Noticias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Noticia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'authors:ntext',
            'title:ntext',
            'description:ntext',
            'date',
            //'createdAt',
            //'updatedAt',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Noticia $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'news_id' => $model->news_id]);
                 }
            ],
        ],
    ]); ?>


</div>
