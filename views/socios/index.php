<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Socios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Socio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'nombre',
            [
                'attribute' => 'apellidos',
                'value' => function($model) {
                    return strtoupper($model->apellidos);
                }
            ],
            'edad',
            [
                'attribute' => 'foto',
                'format' => 'image',
                'value' => function ($model) {
                    return $model->getImagen();
                },
                'contentOptions' => ['class' => 'grid-socios'],
            ],
            [
                'attribute' => 'mas', //aqui se crea un enlace
                'format' => 'html',
                'value' => function($model) {
                    return Html::a('', ['socios/mas', 'id' => $model->id]);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}{clientes}{todo}',
                //persolanizacion de botones
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-list fa-2x"></span>', ['index', 'id' => $model->id]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="fa fa-pencil-square fa-2x"></span>', ['update', 'id' => $model->id]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eraser fa-2x"></span>', ['delete', 'id' => $model->id]);
                    },
                    'clientes' => function($url, $model) {
                        //le manda a la accion index1 y le pasa el id
                        return Html::a('<span class="fa fa-address-book fa-2x"></span>', ['index1', 'id' => $model->id]);
                    },
                    'todo' => function($url, $model) {
                        return Html::a('<span class="fa fa-globe fa-2x"></span>', ['index2', 'id' => $model->id]);
                    }
                ],
            ],
        ],
    ]);
    ?>
</div>

<?php
//compruebo si me llega algo en el modelo por get
if ($modelo) {
    //si tiene datos es que se ha pasado el id de unos de los socios y 
    //con ese id crea un modelo con todos los datos de ese socio
    echo $this->render("_modal", [
        //llamo a la subvista modal y le paso el modelo
        "modelo" => $modelo,
    ]);
}
?>