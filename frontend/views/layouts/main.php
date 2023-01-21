<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?=$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Url::to('@web/favicon.ico')])?>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo-completo-removebg.png',['alt' => Yii::$app->name, 'class' => 'img-logo']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Membros', 'url' => ['/membros/index']],
        ['label' => 'Projetos', 'url' => ['/projeto/index']],
        ['label' => 'Noticías', 'url' => ['/noticia/index']],
        ['label' => 'Artigos', 'url' => ['/artigo/index']],
        ['label' => 'Teses', 'url' => ['/tese/index']],
        ['label' => 'Agenda', 'url' => ['/evento/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
        <?php if(isset($this->params['breadcrumbs'])):?>
          <?=$this->render('//commons/_breadcrumbs', [
            'breadcrumbs' => $this->params['breadcrumbs']
          ])?>
        <?php endif?>
        <?= Alert::widget() ?>
        <?= $content ?>
</main>

<footer>
    <div class="row container-fluid borda-top">
      <div class="col-4 text-center logo-footer">
        <?=Html::img('@web/images/Logo.png',['alt' => 'Triunfo']);?>
        <div id="nome-observatorio"><strong>OBSERVATÓRIO</strong></div>
        <div id="nome-ifsul">ept do IFSUL</div>
      </div>
      <div class="col-4 text-right">
      O Observatório da Educação Profissional e Tecnológica (EPT) IFSul tem sua origem em demandas que tematizam a história e os rumos das políticas educacionais em EPT, trata-se de um projeto que conta com o apoio da Fapergs e da Seção Sinasefe IFSul.
      </div>
      <div class="col-4">
        <div class="row">
          <div class="col-12 box-footer">
            <span class="material-symbols-outlined">phone</span>
            (51) 3654-6308
          </div>
          <div class="col-12 box-footer">
            <span class="material-symbols-outlined">email</span>
            observatorioept@ifsul.rs.br
          </div>
        </div>
      </div>
      <div class="col-12">
        <hr />
        <div class="text-right">
            <a href="" target="_blank" class="midia-footer">
            <?=Html::img('@web/images/facebook.png',['alt' => 'Facebook','width'=>'24']);?></a>
            <a href="https://www.instagram.com/observatorioifsul/" target="blank" class="midia-footer">
            <?=Html::img('@web/images/instagram.png',['alt' => 'Instagram','width'=>'24']);?></a>
            <a href="https://www.youtube.com/c/Observat%C3%B3rioEPTIFSul" target="_blank" class="midia-footer">
            <?=Html::img('@web/images/youtube.png',['alt' => 'Youtube','width'=>'24']);?></a>
            <a href="" target="_blank" class="midia-footer">
            <?=Html::img('@web/images/twitter.png',['alt' => 'Twitter','width'=>'24']);?></a>
            <a href="" target="_blank" class="midia-footer">
            <?=Html::img('@web/images/spotify.png',['alt' => 'Spotify','width'=>'24']);?></a>
            <a href="" target="_blank" class="midia-footer">
            <?=Html::img('@web/images/whatsapp.png',['alt' => 'Whatsapp','width'=>'24']);?></a>
        </div>
      </div>
    </div>
  </footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
