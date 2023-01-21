<?php
use yii\helpers\Html;
use kartik\icons\Icon;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Observatório do IFSUL';
?>
<div class="site-index bg-dark">
    
    <div class="body-content">
<section>
   <div class="row">
     <div class="col-12 banner-background">
           <?=Html::img('@web/images/banner-capa.jpg',['alt' => 'Banner','width'=>'100%', 'class' => 'banner-capa']);?>
     </div>
  </div>
</section>

<br /><br />
<!-- NOTÍCIAS , ATALHOS -->
<section id="noticia-capa" class="bg-verde-claro">
      <div class="row container section-padding-fundo">
         <div class="col-12">
            <h2 class="titulo">Últimas notícias<span class="square"></span></h2>
         </div>
         <?php if($noticiaPrincipal):?>
            <div class="col-6">
               <a href="<?=Url::to(['noticia/view', 'id' => $noticiaPrincipal->news_id])?>">
                  <article class="col-12 nopadding home-noticia-principal">
                     <?= Html::img("@web/images/indisponivel.jpg", ['width' => '100%'])?>		  			
                     <strong>
                        <h3><?=$noticiaPrincipal->title?></h3>
                        <span class="tarja"></span>
                     </strong>
                  </article>
               </a>
            </div>
         <?php endif?>
         <?php if($noticiasDestaque):?>
         <div class="col-6 noticia-secundaria-menor">
            <div id="noticia-secundaria" class="row">
               <?php foreach($noticiasDestaque as $noticiaDestaque):?>
                  <div class="col-6">
                     <a href="<?=Url::to(['noticia/view', 'id' =>1])?>" class="d-block">
                        <div class="home-noticia-secundaria">
                           <?=Html::img("@web/images/indisponivel.jpg", ['width' => '100%', 'title' => "teste"])?>
                           <h3><?=$noticiaDestaque->title?></h3>
                           <div class="tarja"></div>
                        </div>
                     </a>
                  </div>
               <?php endforeach?>
            </div>
         </div>
         <?php endif?>
         <div class="col-ce1-24 text-center">
            <br /><?=Html::a('Todas', ['/noticia/index'], ['class' => 'btn-padrao'])?>
         </div>
      </div>
   </section>



<br /><br />
<!-- LICITAÇÕES , LEGISLAÇÕES, CONTRATAÇÕES -->
<section class="container">
   <div class="row">
      <?php if($artigo):?>
      <div class="col-6">
         <div class="box-lista" style="height:600px; overflow-y:auto">
            <h2 class="titulo">Artigo<span class="square"></span></h2>
            <div class="row">
               <div class="col-12">
                  <br />
                  <a href="<?=Url::to(['artigo/view', 'id' =>$artigo->article_id])?>"><h5 class="nomargin nopadding text-uppercase"><strong><?=$artigo->title?></strong></h5></a>
                  <p>
                  Data de publicação: <?=Yii::$app->formatter->asDate($artigo->data_publicacao,'short');?><br />
                  Veículo de publicação: <?=$artigo->dissemination_vehicle?><br />
                  Autor(es): <?=$artigo->authors?><hr />
                  <?=$artigo->resumo?>
                  </p>
                  <br />
                  <a href="<?=Url::to(['artigo/view', 'id' =>$artigo->article_id])?>" class="btn-padrao fixo">saiba mais</a>
               </div>
            </div>
         </div>
      </div>
      <?php endif?>
      <div class="col-6">
         <div class="box-lista" style="height:600px">
            <h2 class="titulo">Agenda do observatório<span class="square"></span></h2>
            <div class="row">
               <div id="calendario" class="radius4 marginTop25">
                  <br>
               <?= yii2fullcalendar\yii2fullcalendar::widget([
                     'options' => [
                     'lang' => 'pt'
                        ],
                     'events' => $events
                  ]);
               ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<br><br>
<section class="container">
   <div class="row">
      <?php if($tese):?>
      <div class="col-6">
         <div class="box-lista" style="height:550px; overflow-y:auto">
            <h2 class="titulo">Tese<span class="square"></span></h2>
            <div class="row">
               <div class="col-12">
               <br />
                  <a href="#"><h5 class="nomargin nopadding text-uppercase"><strong><?=$tese->title?></strong></h5></a><br>
                  <p>
                  <?=$tese->description?>
                  </p>
                  <br />
                  <?=Html::a('Todas', ['/tese/index'], ['class' => 'btn-padrao fixo'])?>
               </div>
            </div>
         </div>
      </div>
      <?php endif?>
      <?php if($projetos):?>
      <div class="col-6">
            <div class="box-lista" style="height:550px">
               <h2 class="titulo">Projetos<span class="square"></span></h2>
               <div class="row">
                  <div class="col-12" style="height:450px; overflow-y:auto">
                        <?php foreach($projetos as $projeto):?>
                        <div class="row lista-departamento-home">
                           <div class="col-1"><span class="material-symbols-outlined">book</span></div>
                           <div class="col-11"><a href=<?=Url::to(['projeto/view', 'id' =>$projeto->project_id])?>><strong><?=$projeto->title?></strong><br /><small></small></a></div>
                        </div>
                        <?php endforeach?>
                  </div>
               </div>
            </div>
         </div>
         <?php endif?>
   </div>

</section>
<br>

