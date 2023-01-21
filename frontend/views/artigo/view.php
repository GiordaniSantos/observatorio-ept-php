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
                        <div class="col-ce1-24 text-right">
                            <a href="#" class="icone icone-print"><i><?=Icon::show('print')?></i></a>
                            <?=$this->render('//commons/_botoes');?>
                        </div>
                    </div>
                    <?php if($model->authors): ?>
                        <strong>Autor(es):</strong> <?=$model->authors?><br />
                    <?php endif ?>
                    <?php if($model->dissemination_vehicle): ?>
                        <strong>Veículo de publicação:</strong> <?=$model->dissemination_vehicle?><br />
                    <?php endif ?>
                    <br>
                    <?php if($model->descricao): ?>
                        <?=Yii::$app->formatter->asHtml($model->descricao)?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid"><?=$this->render('//commons/_botaoVoltar')?></div>
