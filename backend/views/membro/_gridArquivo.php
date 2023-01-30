<?php
use yii\grid\GridView;
use yii\helpers\Html;
use kartik\icons\Icon;
use yii\helpers\Url;
use common\models\Arquivo;

use backend\assets\ArquivoAsset;
ArquivoAsset::register($this);

Icon::map($this, Icon::FA);
?>

<div class="col-md-12">
    <?= GridView::widget([
        'id' => 'membro-anexos-grid',
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'class' => 'table table-responsive table-striped table-bordered table-hover',
        ],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'width: 20px;', 'class' => 'text-center'],
            ],
            [
                'attribute' => 'arquivo',
                'format' => 'raw',
                'label' => 'Arquivo',
                'value' => function ($model) {

                    $version = ($model->tipo == Arquivo::TIPO_IMAGEM) ? Arquivo::VERSION_LARGE : null;
                    $file = $model->getFileUrl('membro',$version);
                    
                    $linkContent = Icon::show($model->getFileIcon(), ['class'=>'fa-5x']);

                    return Html::a($linkContent,$file,[
                        'target' => '_blank',
                        'title' => $model->nome_original,
                        'data-pjax' => 0
                    ]);
                },
            ],
            [
                'attribute' => 'descricao',
                'format' => 'raw',
                'label' => 'Nome',
                'value' => function ($model) {
                    return Html::label($model->nome_original.' ('.$model->getFormattedFileSize().')');
                },
            ],
            [
                'attribute' => 'legenda',
                'format' => 'raw',
                'label' => 'Legenda',
                'value' => function ($model) {
                    return Html::input('text','legenda-arquivo-'.$model->id,$model->legenda,[
                        'id' => 'fw-legenda-arquivo-'.$model->id,
                        'placeholder' => 'Editar Legenda',
                        'class' => 'fw-legenda-arquivo form-control'
                    ]);
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url,$model) {
                        $location = Url::current();
                        $url = Url::toRoute(['/membro/delete-arquivo', 'id' => $model->id]);
                        return  Html::a('excluir', $url, [
                            'title' => 'Deletar Arquivo',
                            //'class' => 'sa-delete',
                            'onclick' => "
                                swal({
                                    title: 'Exclusão de Arquivo',
                                    text: 'Deseja realmente excluir este arquivo?',
                                    type: 'warning',
                                    cancelButtonText: 'Cancelar',
                                    showCancelButton: true,
                                    confirmButtonText: 'Sim',
                                    closeOnConfirm: false,
                                    showLoaderOnConfirm: true
                                },
                                function(isConfirm){
                                    if (isConfirm) {
                                         jQuery.ajax({
                                            cache: true,
                                            url: '$url',
                                            type: 'POST',
                                            data: {id : id}
                                         }).done(function(data) {
                                            if (data && data == 'success') {
                                                $.pjax.reload({container:\"#grid-arquivo-membro\"});
                                                swal(
                                                    'Excluído!',
                                                    'Registro removido com sucesso.',
                                                    'success'
                                                );
                                            } else {
                                                swal(
                                                    'Erro!',
                                                    'Houve um erro ao remover o registro. '+data,
                                                    'error'
                                                );
                                            }
                                            return false;
                                        });
                                        return false;
                                    }
                                });
                                return false;",
                        ]);
                    },
                ]
            ],
        ],
    ]);
    ?>
</div>
