<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Inflector;
use kartik\icons\Icon;
use yii\widgets\ListView;
use dynamikaweb\seo\SeoHelper;
use common\models\Pessoa;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Artigos'), 'url' => ['artigo/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section>
    <div class="container">
        <div class="row">
            <div id="conteudo_view" class="col">
                <div class="box-lista padding30">
                    <h3><strong><?=$model->title?></strong></h3>
                    <div class="row">
                        <div class="col-12 text-right">
                            <a href="#" class="icone icone-print"><i><?=Icon::show('print')?></i></a>
                            <?=$this->render('//commons/_botoes');?>
                        </div>
                    </div>
                    <?php if($model->data_publicacao): ?>
                        <strong>Data de publicação:</strong> <?=Yii::$app->formatter->asDate($model->data_publicacao,'long');?><br />
                    <?php endif ?>
                    <?php if($model->members): ?>
                        <strong>Membros:</strong> <?=$model->members?><br />
                    <?php endif ?>
                    <?php if($model->financiers): ?>
                        <strong>Financiadores:</strong> <?=$model->financiers?><br />
                    <?php endif ?>
                    <br>
                    <?php if($model->description): ?>
                        <?=Yii::$app->formatter->asHtml($model->description)?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid"><?=$this->render('//commons/_botaoVoltar')?></div>
