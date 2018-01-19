<?php

namespace app\widgets;
use yii\helpers\Html;
use Yii;

class Modal extends \yii\base\Widget {
    public $opciones=[];
    public $boton="botonModal";
    public $contenido="modalContent";

    public function init() {
        $this->opciones=array_merge([
            "header"=>"Ejemplo",
            "id"=>"modal",
            "size"=>"modal-lg",
            'closeButton' => [
                'label' => 'Cerrar',
                'class' => 'btn btn-danger btn-sm pull-right',
            ],
            'footer'=> Html::a('Cerrar',['#'],['class'=>'btn btn-danger btn-sm pull-right','data-dismiss'=>'modal']),
        ],$this->opciones);
        parent::init();
    }

    public function run() {
        \yii\bootstrap\Modal::begin($this->opciones);
        echo "<div id='$this->contenido'></div>";
        \yii\bootstrap\Modal::end();
   
        $this->getView()->registerJs(
                "$(function(){
    $('.$this->boton').click(function (){
        $.get($(this).attr('href'), function(data) {
          $('#" . $this->opciones['id'] . "').modal('show').find('#$this->contenido').html(data)
       });
       return false;
    });
});");
    }

}
