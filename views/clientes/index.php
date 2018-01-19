<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Clientes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

     <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'nombre',
            'direccion',
            'email',
            'socio',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-user"></span>', ['clientes/view1', 'id' => $model->id],['class' => 'modalButton']);
                    },
                ],
            ],
        ],
    ]);
    ?>
</div>


<?php
// Uso del widget modal(recoge lo del enlace y lo renderiza en el modal)
// En la accion view1 del controlador clientes hace un renderPartial para que no lo muestre dentro
// del Layout
    echo app\widgets\Modal::widget([
        "boton"=>"modalButton"
    ]);
?>