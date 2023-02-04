<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Inflector;
use kartik\icons\Icon;
use yii\widgets\ListView;
use dynamikaweb\seo\SeoHelper;
use dynamikaweb\tiny\Slider;
use common\models\Pessoa;
use common\models\Noticia;
use common\models\Arquivo;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Noticias'), 'url' => ['noticia/index']];
$this->params['breadcrumbs'][] = $this->title;

$fotos = $model->getGalleryItems('noticiaArquivos','id_noticia', $options = ['clover' => false]);
$dataProviderArquivos = $model->getDataProviderArquivos(Noticia::TIPO_DOCUMENTO, ['order' => 'posicao']);
$capa = $model->getImagemCapa('noticiaArquivos','id_noticia');
?>
<section>
    <div class="container">
        <div class="row">
            <div id="conteudo_view" class="col-12">
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
                            <?php if($model->getImagemCapa('noticiaArquivos','id_noticia',Arquivo::VERSION_LARGE, false)):?>
                                <?=Html::img($model->getImagemCapa('noticiaArquivos','id_noticia',Arquivo::VERSION_LARGE),['width'=>'100%','class' => 'foto-view-noticia']);?>
                            <?php else:?>
                                <?=Html::img("@web/images/indisponivel.jpg", ['width' => '100%', 'class' => 'foto-view-noticia'])?>
                            <?php endif?>      
                            <?=Yii::$app->formatter->asHtml($model->description)?>
                            </div>
                    <?php endif ?>
                    <?php if ($model->hasFile(\common\models\Arquivo::TIPO_IMAGEM)): ?>
                        <? if ($fotos) { ?>
                        <div class="row">
                            <div class="col-12">
                                <br />
                                <?php Slider::begin([
                                    'pluginOptions' => [
                                        'autoplayButtonOutput' => false,
                                        'autoplay'          => true,
                                        'mouseDrag'         => true,
                                        'autoHeight'        => true,
                                        'controls'          => false,
                                        'autoplayTimeout'   => 3000,
                                        'items'             => 1
                                    ]
                                ])?>
                                <?php foreach($fotos as $foto):?>
                                        <?php if($capa != $foto->link): ?>
                                            <?=Html::img($foto->link, ['alt' => $foto->legenda])?>
                                        <?php endif ?>
                                        <?php if($foto->legenda):?>
                                            <span><?=$foto->legenda?></span>
                                        <?php endif?>
                                <?php endforeach?>
                                <?php Slider::end()?>
                            </div>
                        </div>
                        <? } ?>
                    <?php endif ?>
                    <?php if ($dataProviderArquivos->count): ?>
                        <br /><br />
                        <div class="row">
                            <div class="col-12">
                                <h6 class="nomargin padding10 bg-light"><strong>Anexos</strong></h6>
                                <?=ListView::widget([
                                    'dataProvider' => $dataProviderArquivos,
                                    'layout' => "{items}",
                                    'itemView' => function ($model_file) use ($model){
                                        return $this->render('//commons/anexo/_list_item', [
                                            'model_file' => $model_file,
                                            'model' => $model
                                        ]);
                                    }
                                ])?>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid"><?=$this->render('//commons/_botaoVoltar')?></div>
