<?php
use yii\widgets\ListView;
use common\models\Evento;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\icons\Icon;

$this->title = "Calendário do Observatório";
$this->params['breadcrumbs'][] = $this->title;

?>
<section>
    <div class="container">
        <div class="row">
            <div id="calendar"></div>
                <!-- MIOLO -->
                <div class="col order-1">
                    <div class="box-lista">
                        <div class="padding30">
                            <?= yii2fullcalendar\yii2fullcalendar::widget([
                                'options' => [
                                    'lang' => 'pt',
                                ],
                                'events' => $events
                            ]);
                            ?>
                        </div>    
                    </div>
                    <br /><br />
                </div>
                <!-- LATERAL -->
                <?php if(Evento::getDataProvider(['where' => 'destaque = true', 'limit' => 4, 'classname' => Evento::classname()])->count):?>
                    <div class="col-4 order-md-2">
                        <?= ListView::widget([
                            'dataProvider' => Evento::getDataProvider(['where' => 'destaque = true', 'limit' => 4, 'classname' => Evento::classname()]),
                            'layout' => '{items}',
                            'itemView' => fn($model) => $this->render('_list_item_box', ['model' => $model]),
                        ]); ?>
                    </div>
                <?php endif;?>
            </div>
            <?= ListView::widget([
                'layout' => '<div class="row">{items}</div>',
                'itemOptions' => ['class' => 'col-12'],
                'dataProvider' =>Evento::getDataProvider(['where' => 'destaque != true', 'classname' => Evento::classname()]),
                'itemView' => fn($model) => $this->render('_list_item_box', ['model' => $model]),
            ])?>
            <br><br>
        </div>
    </div>
</section>
