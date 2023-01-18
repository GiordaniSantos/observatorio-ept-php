<?php

use common\models\Projeto;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ProjetoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Projetos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projeto-index margin110T">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Projeto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title:ntext',
            'description:ntext',
            'members:ntext',
            'financiers:ntext',
            //'createdAt',
            //'updatedAt',
            //'curriculumId',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Projeto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'project_id' => $model->project_id]);
                 }
            ],
        ],
    ]); ?>


</div>
