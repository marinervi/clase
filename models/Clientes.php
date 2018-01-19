<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property int $id
 * @property string $nombre
 * @property string $direccion
 * @property string $email
 * @property int $socio
 *
 * @property Socios $socio0
 */
class Clientes extends \yii\db\ActiveRecord
{
   
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['socio'], 'integer'],
            [['nombre', 'direccion'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 50],
            [['socio'], 'exist', 'skipOnError' => true, 'targetClass' => Socios::className(), 'targetAttribute' => ['socio' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'direccion' => 'Direccion',
            'email' => 'Email',
            'socio' => 'Socio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocio0()
    {
        return $this->hasOne(Socios::className(), ['id' => 'socio']);
        //hasOne quiere decir que tiene una relacion de uno
    }
    

}
