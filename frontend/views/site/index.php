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
         <div class="col-6">
         <a href="<?=Url::to(['noticia/view', 'id' =>1])?>">
            <article class="col-12 nopadding home-noticia-principal">
               <?= Html::img("@web/images/noticia-capa.jpg", ['width' => '100%'])?>		  			
               <strong>
                  <h3>teste</h3>
                  <span class="tarja"></span>
               </strong>
            </article>
         </a>
         </div>
         <div class="col-6 noticia-secundaria-menor">
            <div id="noticia-secundaria" class="row">
               <div class="col-6">
                  <a href="<?=Url::to(['noticia/view', 'id' =>1])?>" class="d-block">
                     <div class="home-noticia-secundaria">
                        <?=Html::img("@web/images/noticia-capa.jpg", ['width' => '100%', 'title' => "teste"])?>
                        <h3>teste</h3>
                        <div class="tarja"></div>
                     </div>
                  </a>
               </div>
               <div class="col-6">
                  <a href="<?=Url::to(['noticia/view', 'id' =>1])?>" class="d-block">
                     <div class="home-noticia-secundaria">
                        <?=Html::img("@web/images/noticia-capa.jpg", ['width' => '100%', 'title' => "teste"])?>
                        <h3>teste</h3>
                        <div class="tarja"></div>
                     </div>
                  </a>
               </div>
               <div class="col-6">
                  <a href="<?=Url::to(['noticia/view', 'id' =>1])?>" class="d-block">
                     <div class="home-noticia-secundaria">
                        <?=Html::img("@web/images/noticia-capa.jpg", ['width' => '100%', 'title' => "teste"])?>
                        <h3>teste</h3>
                        <div class="tarja"></div>
                     </div>
                  </a>
               </div>
               <div class="col-6">
                  <a href="<?=Url::to(['noticia/view', 'id' =>1])?>" class="d-block">
                     <div class="home-noticia-secundaria">
                        <?=Html::img("@web/images/noticia-capa.jpg", ['width' => '100%', 'title' => "teste"])?>
                        <h3>teste</h3>
                        <div class="tarja"></div>
                     </div>
                  </a>
               </div>
            </div>
         </div>
         <div class="col-ce1-24 text-center">
            <br /><?=Html::a('Todas', ['/noticia/index'], ['class' => 'btn-padrao'])?>
         </div>
      </div>
   </section>



<br /><br />
<!-- LICITAÇÕES , LEGISLAÇÕES, CONTRATAÇÕES -->
<section class="container">
   <div class="row">
      <div class="col-6">
         <div class="box-lista" style="height:650px; overflow-y:auto">
            <h2 class="titulo">Artigo<span class="square"></span></h2>
            <div class="row">
               <div class="col-ce1-24">
                  <br />
                  <a href="#"><h5 class="nomargin nopadding text-uppercase"><strong>Pregão Presencial nº 02/2023</strong></h5></a>
                  <p>
                  Abertura: 11/01<br />
                  Horário: 10:00<br />
                  Local: Setor de Licitações - Prefeitura de Triunfo<hr />
                  Contratação de empresa para aquisição de refletores conforme termo de referência, para atender a demanda da Secretaria Municipal de Juventude e Esporte.
                  </p>
                  <br />
                  <a href="#" class="btn-padrao fixo">saiba mais</a>
               </div>
            </div>
         </div>
      </div>
      <div class="col-6">
         <div class="box-lista" style="height:650px">
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
      <div class="col-6">
         <div class="box-lista" style="height:550px; overflow-y:auto">
            <h2 class="titulo">Contratações<span class="square"></span></h2>
            <div class="row">
               <div class="col-12">
               <br />
                  <a href="#"><h5 class="nomargin nopadding text-uppercase"><strong>Processo Seletivo nº 19/2022</strong></h5></a>
                  <p>
                  O Prefeito de Triunfo, no uso de suas atribuições legais, torna público para conhecimento dos interessados que estão abertas as inscrições para o Banco de Cadastro Reserva para Contratação Emergencial da Secretaria Municipal de Cidadania e Inclusão Social, por meio de prova de títulos para o exercício da função de Assistente Social, amparado em excepcional interesse público, com fulcro no art. 37, IX, da Constituição da República, e art. 194 da Lei Municipal nº 2.405/2006.
                  </p>
                  <br />
                  <a href="#" class="btn-padrao fixo">convocações</a>
               </div>
            </div>
         </div>
      </div>
      <div class="col-6">
            <div class="box-lista" style="height:550px">
               <h2 class="titulo">Projetos<span class="square"></span></h2>
               <div class="row">
                  <div class="col-12" style="height:450px; overflow-y:auto">
                     
                        <div class="row lista-departamento-home">
                           <div class="col-1"><span class="material-symbols-outlined">account_circle</span></div>
                           <div class="col-11"><a href="/departamento"><strong>Departamentos</strong><br /><small>2 unidades</small></a></div>
                        </div>
                        <div class="row lista-departamento-home">
                           <div class="col-1"><span class="material-symbols-outlined">account_circle</span></div>
                           <div class="col-1"><a href="/departamento?DepartamentoSearch%5Bid_secretaria%5D=&DepartamentoSearch%5Bid_departamento_categoria%5D=1&DepartamentoSearch%5Bq%5D="><strong>Setores</strong><br /><small>unidades</small></a></div>
                        </div>
                        <div class="row lista-departamento-home">
                           <div class="col-1"><span class="material-symbols-outlined">account_circle</span></div>
                           <div class="col-11"><a href="/departamento?DepartamentoSearch%5Bid_secretaria%5D=&DepartamentoSearch%5Bid_departamento_categoria%5D=2&DepartamentoSearch%5Bq%5D="><strong>Órgãos</strong><br /><small> documentos</small></a></div>
                        </div>
                   
                     
                        <div class="row lista-departamento-home">
                           <div class="col-1"><span class="material-symbols-outlined">account_circle</span></div>
                           <div class="col-11"><a href="/departamento?DepartamentoSearch%5Bid_secretaria%5D=&DepartamentoSearch%5Bid_departamento_categoria%5D=3&DepartamentoSearch%5Bq%5D="><strong>Conselhos</strong><br /><small> documentos</small></a></div>
                        </div>
                     
                     
                        <div class="row lista-departamento-home">
                           <div class="col-1"><span class="material-symbols-outlined">account_circle</span></div>
                           <div class="col-11"><a href="/escola"><strong>Escolas Municipais</strong><br /><small> unidades</small></a></div>
                        </div>
                  
                        <div class="row lista-departamento-home">
                           <div class="col-1"><span class="material-symbols-outlined">account_circle</span></div>
                           <div class="col-11"><a href="/unidade-saude"><strong>Unidades de Saúde</strong><br /><small> unidades</small></a></div>
                        </div>
                     
                        <div class="row lista-departamento-home">
                           <div class="col-1"><span class="material-symbols-outlined">account_circle</span></div>
                           <div class="col-11"><a href="/entidade"><strong>Entidades Municipais</strong><br /><small> unidades</small></a></div>
                        </div>
                  </div>
               </div>
            </div>
         </div>
   </div>

</section>
<br>

