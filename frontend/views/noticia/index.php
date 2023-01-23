<?php
use yii\widgets\ListView;
use yii\bootstrap5\Tabs;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use common\models\Artigo;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\icons\Icon;

$this->title = "Notícias";
$this->params['breadcrumbs'][] = 'Notícias';
?>

<section>
    <div class="container">
        <div class="row">
            <!-- MIOLO -->
            <div class="col order-1">
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemOptions' => ['class' => 'col-6 col-tb2-8 col-pc2-8'],                        
                    'layout' => '<div class="row">{items}</div>{pager}',
                    'itemView' => fn($model) => $this->render('_list_item', ['model' => $model]),
                ]); ?> 
            </div>
             <!-- LATERAL -->
            <div class="col-4 order-0 order-md-2">
                <div class="box padding-busca">
                    <strong>Filtros</strong>
                    <hr />
                    <p>Abaixo você poderá realizar filtros de acordo com seu interesse.</p>
                    <?php $form = ActiveForm::begin(['method' => 'GET']) ?>
                    <?= $form->field($searchModel, 'title')->textInput(['placeholder' => 'Termo ...'])->label(false) ?>
                    <?= Html::submitButton(Icon::show('search')."Buscar", ['class' => 'btn-padrao'])?>
                    <?= Html::a(Icon::show('recycle')."Limpar", ['noticia/index'], ['class' => 'btn-padrao'])?>
                    <?php ActiveForm::end(); ?>
                </div>
                <br />
            </div>
        </div>
    </div>
</section>
