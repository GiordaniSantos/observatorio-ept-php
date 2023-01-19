<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
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
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Membros', 'url' => ['/members/index']],
        ['label' => 'Projetos', 'url' => ['/projects/index']],
        ['label' => 'Noticías', 'url' => ['/news/index']],
        ['label' => 'Artigos', 'url' => ['/articles/index']],
        ['label' => 'Teses', 'url' => ['/theses/index']],
        ['label' => 'Agenda', 'url' => ['/schedules/index']],
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
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
 
        <div id="rodape">
                <div class="row">
                    <div class="col-6">
                        <b>Acompanhe nossas redes:</b>
                        <ul>
                            <li><a class="link link--metis" rel="noreferrer" href="https://www.instagram.com/observatorioifsul/" target="_blank">Instagram</a></li>
                            <li><a class="link link--metis" rel="noreferrer" href="#" target="_blank">Facebook</a></li>
                            <li><a class="link link--metis" rel="noreferrer" href="https://www.youtube.com/c/Observat%C3%B3rioEPTIFSul" target="_blank">YouTube</a></li>
                        </ul>                            
                    </div>

                    <div class="col-6">
                        <b>Institucional e parcerias:</b>
                        <ul>
                            <li><a class="link link--metis" rel="noreferrer" href="http://www.ifsul.edu.br/" target="_blank">IFSul</a></li>
                            <li><a class="link link--metis" rel="noreferrer" href="https://www.sinasefeifsul.org.br/" target="_blank">Sinasefe IFSul</a></li>
                            <li><a class="link link--metis" rel="noreferrer" href="https://www.ufrgs.br/observatoriodoensinomedio-rs/" target="_blank">Observatório do Ensino Médio – RS</a></li>
                        </ul>
                    </div>
                </div> 

                <div class="row">
                        Nosso e-mail: observatorioept.ifsul(AT)gmail.com
                </div>

                <div class="row">
                    
                        Observatório EPT do IFSul. 2021. Todos os direitos reservados.
                    
                </div>
            </div>
    
     
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
