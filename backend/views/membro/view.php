<?php

use yii\helpers\Html;
use common\models\Arquivo;
use yii\widgets\DetailView;
use kartik\icons\Icon;

/** @var yii\web\View $this */
/** @var common\models\Membro $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Membros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="membro-view margin110T">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você tem certeza que quer deletar esse item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute'=>'Anexo',
                'format' => 'raw',
                'value'=> function($model) {
                    $arquivo = $model->arquivo;
                    
                    if (!$arquivo) return null;

                    $version = ($arquivo->tipo == Arquivo::TIPO_IMAGEM) ? Arquivo::VERSION_LARGE : null;

                    $file = $arquivo->getFileUrl('documento',$version);
                    $linkContent = Icon::show($arquivo->getFileIcon(), ['class'=>'fa-5x']);
                    
                    return \yii\helpers\Html::a($linkContent,$file,[
                        'target' => '_blank',
                        'title' => $arquivo->nome_original,
                    ]);
                },
            
            ],
            'institution',
            'link_curriculum',
            'createdAt',
            'updatedAt',
        ],
    ]) ?>

</div>
