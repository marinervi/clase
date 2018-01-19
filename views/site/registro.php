<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Darme de Alta';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="usuarios-form">

        <?php
        $form = ActiveForm::begin([
            'id' => $model->formName(),
            'enableAjaxValidation'=>true,
            //'validationUrl' => ['site/ajax'],

        ]);

        /* vamos a colocar un alert con los mensajes de error del formulario */

        echo \yii\bootstrap\Alert::widget([
            'body' => $form->errorSummary($model, [
                'header' => 'Los errores en el formulario son los siguientes:'
            ]),
        ]);
        ?>

        <?= $form->field($model, 'usuario')->textInput(['maxlength' => true])
        ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]); ?>        

        <?=
        $form->field($model, 'codigo')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            'imageOptions' => [
                'id' => 'my-captcha-image'
            ],
            'options' => [
                'placeholder' => 'Escribe el codigo aqui'
            ]
        ])
        ?>
        <div class="form-group">
            <?php
            echo Html::tag('div', 'Cambiame la imagen', [
                'id' => 'refresh-captcha',
                'class' => 'btn btn-info btn-xs'
            ]);
            ?>
            <?php $this->registerJs("
            $('#refresh-captcha').on('click', function(e){
                e.preventDefault();
                $('#my-captcha-image').yiiCaptcha('refresh');
            })
        ");
            ?>
        </div>

        <div class="form-group">
<?= Html::submitButton('Registrame', ['class' => 'btn btn-success']) ?>
        </div>

<?php ActiveForm::end(); ?>

    </div>


</div>




