<?php

use common\models\Tese;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\TeseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Teses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tese-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Tese', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title:ntext',
            'institution',
            'publishing_company',
            'author',
            //'description:ntext',
            //'access_link',
            //'createdAt',
            //'updatedAt',
            //'curriculumId',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tese $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'thesis_id' => $model->thesis_id]);
                 }
            ],
        ],
    ]); ?>


</div>
