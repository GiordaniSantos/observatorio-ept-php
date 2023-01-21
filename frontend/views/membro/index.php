<?php
use yii\widgets\ListView;
use yii\bootstrap5\Tabs;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use common\models\Membro;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\icons\Icon;

$this->title = "Membros";
$this->params['breadcrumbs'][] = 'Membros';
?>

<section>
    <div class="container">
        <div class="row">
            <!-- MIOLO -->
            <div class="col-12 order-1">
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => fn($model) => $this->render('_list_item', ['model' => $model]),
                ]); ?>
            </div>
        </div>
    </div>
</section>
