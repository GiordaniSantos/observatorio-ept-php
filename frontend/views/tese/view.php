<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Inflector;
use kartik\icons\Icon;
use yii\widgets\ListView;
use dynamikaweb\seo\SeoHelper;
use common\models\Pessoa;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Teses'), 'url' => ['tese/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section>
    <div class="container">
        <div class="row">
            <div id="conteudo_view" class="col">
                <div class="box-lista padding30">
                    <h3><strong><?=$model->title?></strong></h3>
                    <div class="row">
                        <div class="col-ce1-24 text-right">
                            <a href="#" class="icone icone-print"><i><?=Icon::show('print')?></i></a>
                            <?=$this->render('//commons/_botoes');?>
                        </div>
                    </div>
                    <?php if($model->access_link):?>
                        <a href=<?=$model->access_link?> target="_blank">Link de acesso à publicação</a><br>
                    <?php endif?>
                    <?php if($model->author): ?>
                        <strong>Autor:</strong> <?=$model->author?><br />
                    <?php endif ?>
                    <?php if($model->data_publicacao): ?>
                        <strong>Data de publicação:</strong> <?=Yii::$app->formatter->asDate($model->data_publicacao,'long');?><br />
                    <?php endif ?>
                    <?php if($model->publishing_company): ?>
                        <strong>Veículo de publicação:</strong> <?=$model->publishing_company?><br />
                    <?php endif ?>
                    <?php if($model->institution): ?>
                        <strong>Instituição do autor:</strong> <?=$model->institution?><br />
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
