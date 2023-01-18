<?php

use common\models\Membro;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\MembroSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Membros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membro-index margin110T">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Membro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'institution',
            'link_curriculum',
            'createdAt',
            //'updatedAt',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Membro $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'member_id' => $model->member_id]);
                 }
            ],
        ],
    ]); ?>


</div>
