<?php 

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\icons\Icon;

$segundoNivel = current($breadcrumbs);
$segundoNivel = is_array($segundoNivel)? ArrayHelper::getValue($segundoNivel, 'label', $this->title): $segundoNivel;
?>

<section class="bg-breadcrumb">
    <div class="container">
        <div class="row d-flex justify-content-between">
            <div class="col-4 text-left">
                <h2 class="titulo-bc"><?=$segundoNivel?><span class="square"></span></h2>
            </div>
            <div class="col-8 text-right">
                <?=Breadcrumbs::widget([
                     'links' => $breadcrumbs,
                     'options' => [
                        'class' => 'breadcrumb'],
                  ])?>
            </div>
        </div>
    </div>    
</section>