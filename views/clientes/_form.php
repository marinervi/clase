<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; 
use app\models\Socios;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'socio')->textInput() ?>
    
     <?= $form->field($model, 'socio')->dropDownList(
             //trabajar con array mapeando campos (clave,valor)
            ArrayHelper::map(Socios::find()->select(['id',new \yii\db\Expression("CONCAT(nombre, ' ' ,apellidos) as salida")])->asArray()->all(),'id','salida'),
            ['prompt'=>'Select XYZ']
       )?> 

    <?= $form->field($model, 'socio')->dropDownList(
            ArrayHelper::map(Yii::$app->db->createCommand('Select id, CONCAT(nombre," ",apellidos) as completo from socios')->queryAll(),'id','completo'),
            ['prompt'=>'Select XYZ']
       )?> 
    
    
    <?= $form->field($model, 'socio')->dropDownList(
            ArrayHelper::map((new \yii\db\Query())->select(['id','CONCAT(nombre," ",apellidos) as completo'])->from('socios')->all(),'id','completo'),
            ['prompt'=>'Select XYZ']
       )?> 
    
        <?= $form->field($model, 'socio')->dropDownList(
            ArrayHelper::map(Socios::findBySql('Select id, CONCAT(nombre," ",apellidos) as completo from socios')->asArray()->all(),'id','completo'),
            ['prompt'=>'Select XYZ']
       )?> 
     
     
     
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

    
