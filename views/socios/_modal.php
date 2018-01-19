<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;


Modal::begin([
    /*'closeButton' => [
        'label' => 'Cerrar',
        'class' => 'btn btn-danger btn-sm pull-right',
    ],*/
    'header'=>'Gestion de Socios',
    'size' => 'modal-lg',
    'clientOptions' => ['show' => true],
    'footer'=> Html::button('Cerrar',['class'=>'btn btn-danger btn-sm pull-right','data-dismiss'=>'modal']),
]);

//dentro de modal renderizamos en la vista view
echo $this->render("view",[
    "model"=>$modelo
]);

Modal::end();
?>

