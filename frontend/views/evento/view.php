<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\icons\Icon;
use yii\widgets\ListView;

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Eventos'), 'url' => ['evento/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<section>
    <div class="container">
        <div class="row">  
            <div id="conteudo_view" class="col">
                <div class="box-lista padding30">
                    <h3><strong><?=$model->titulo?></strong></h3><hr />
                    <div class="row">
                        <div class="col-12 text-right">
                            <?=$this->render('//commons/_botoes');?>
                        </div>
                    </div>
                    <?php if($model->data_inicio): ?>
                        Data inicial: <?=Yii::$app->formatter->asDate($model->data_inicio,'long');?><br />
                    <?php endif ?>
                    <?php if(Yii::$app->formatter->asDate($model->data_inicio) != Yii::$app->formatter->asDate($model->data_fim)): ?>
                        Data final: <?=Yii::$app->formatter->asDate($model->data_fim,'long');?><br />
                    <?php endif ?>
                    <?php if($model->local): ?>
                        Local: <?=Yii::$app->formatter->asNText($model->local)?><br />
                    <?php endif ?>
                    <br />
                    <?php if($model->descricao): ?>
                        <p><?=Yii::$app->formatter->asHtml($model->descricao)?></p>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid"><?=$this->render('//commons/_botaoVoltar')?></div>
