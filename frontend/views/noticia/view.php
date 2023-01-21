<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Inflector;
use kartik\icons\Icon;
use yii\widgets\ListView;
use dynamikaweb\seo\SeoHelper;
use common\models\Pessoa;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Noticias'), 'url' => ['noticia/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section>
    <div class="container">
        <div class="row">
            <div id="conteudo_view" class="col">
                <div class="box-lista view-news">
                    <h2><strong><?=$model->title?></strong></h2>
                    <div class="row">
                        <div class="col-ce1-24 text-right">
                            <a href="#" class="icone icone-print"><i><?=Icon::show('print')?></i></a>
                            <?=$this->render('//commons/_botoes');?>
                        </div>
                    </div>
                    <?php if($model->data_publicacao): ?>
                        Data de Publicação: <?=Yii::$app->formatter->asDate($model->data_publicacao,'long');?><br />
                    <?php endif ?>
                    <?php if($model->authors): ?>
                        Crédito da Matéria: <?=$model->authors?><br />
                    <?php endif ?>
                    <br /><br />
                    <?php if($model->description): ?>
                        <div class="text-justify">
                            <?=Html::img("@web/images/indisponivel.jpg", ['alt' => $model->title, 'class' => 'foto-view-noticia'])?>        
                            <?=Yii::$app->formatter->asHtml($model->description)?>
                            </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid"><?=$this->render('//commons/_botaoVoltar')?></div>
