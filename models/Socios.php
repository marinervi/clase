<?php

namespace app\models;

use Yii;
use yii\bootstrap\Modal;
use yii\web\UploadedFile;


/**
 * This is the model class for table "socios".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellidos
 * @property int $edad
 *
 * @property Clientes[] $clientes
 */
class Socios extends \yii\db\ActiveRecord {

     
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'socios';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['edad'], 'integer'],
            [['nombre', 'apellidos'], 'string', 'max' => 255],
            [['foto'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'edad' => 'Edad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes() {
        return $this->hasMany(Clientes::className(), ['socio' => 'id']);
    }

    public function getImagen() {
        return Yii::$app->request->getBaseUrl() . '/imgs/' . $this->foto;
    }
    
     public function upload() //este es el que se llama desde el controlador
    {
        if ($this->validate()) {
            $this->foto->name=$this->nombre . $this->foto->name;
            $this->foto->saveAs('imgs/' . $this->foto->name,false);
            return true;
        } else {
            return false;
        }
    }
    
}
