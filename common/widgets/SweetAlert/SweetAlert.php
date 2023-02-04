<?php

namespace common\widgets\SweetAlert;

use yii\base\Widget;

class SweetAlert extends Widget
{
    const TYPE_DELETE_ITEM_DIALOG = 'DI';
    const TYPE_DELETE_FILE_DIALOG = 'DF';

    public $url;
    public $id;
    public $type = null;
    public $pjaxGridId = null;
    public $options = [];
    public $fwType;

    public function run()
    {
        $this->id = ($this->id) ? $this->id : $this->getId(true);

        SweetAlertAsset::register($this->getView());

        $this->registerClientScript();
    }

    public function registerClientScript()
    {
        $view = $this->getView();

        switch($this->type) {
            case self::TYPE_DELETE_FILE_DIALOG:
                $js = $this->renderDeleteFileDialog();
                break;
            case self::TYPE_DELETE_ITEM_DIALOG:
                $js = $this->renderDeleteDialog();
                break;
            default:
                $js = ($this->options) ? "swal({$this->options});" : '';
                break;

        }

        if ($js) {
            $view->registerJs(
                $js,
                $view::POS_READY,
                'yiiSwal'.$this->id
            );
        }
    }

    public function renderDeleteDialog()
    {
        $script = <<<JS
            jQuery(document).on('click','a.sa-delete', function() {
                 var url = $(this).prop('href');
                 var id = url.split("/").pop();

                 swal({
                    title: 'Exclusão de Registro',
                    text: 'Deseja realmente excluir este registro?',
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
                            url: url,
                            type: 'POST',
                            data: {id : id}
                         }).done(function(data) {
                            if (data && data == 'success') {
                                swal(
                                    'Excluído!',
                                    'Registro removido com sucesso.',
                                    'success'
                                );
                                window.location = '{$this->url}'
                            } else {
                                swal(
                                    'Erro!',
                                    'Houve um erro ao remover o registro.'+data,
                                    'error'
                                );
                            }
                        });
                    }
                });
                return false;
            });
JS;

        return $script;
    }

    public function renderDeleteFileDialog()
    {
        $script = <<<JS
            jQuery(document).on('click','a.fw-delete-item', function() {
                var id = jQuery(this).prop('id').split("-").pop();
                var fwType = jQuery('#fw-data').data('type');
                var url = ($(this).prop('href') != 'javascript:;') ? $(this).prop('href') : '{$this->url}';
                var postData = {id : id, fwType : fwType};

                 swal({
                      title: 'Exclusão de Registro',
                      text: 'Deseja realmente excluir este registro?',
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
                                url: url,
                                type: 'POST',
                                data: postData
                             }).done(function(data) {

                                if (data) {
                                    jQuery.pjax.reload({container:"#{$this->pjaxGridId}"});
                                    //jQuery('#{$this->id}').closest('.fw-grid-arquivo').html(data);
                                    jQuery('.fw-legenda-arquivo').on('focusout',function(){
                                        fwSave(id);
                                    });
                                    swal(
                                        'Excluído!',
                                        'O arquivo foi removido.',
                                        'success'
                                    );
                                } else {
                                    swal(
                                        'Erro!',
                                        'Houve um erro ao excluir o arquivo.',
                                        'error'
                                    );
                                }
                             });
                        }
                    })
                    return false;
            });
JS;

        return $script;
    }
}
?>