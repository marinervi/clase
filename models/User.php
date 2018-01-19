<?php

namespace app\models;
use yii\captcha\Captcha;
use yii\captcha\CaptchaAction;
use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    public $password_repeat;
    public $codigo;

    public static function tableName() {
        return 'usuarios';
    }

    public function rules() {
        return [
            [['usuario', 'password'], 'string', 'max' => 255],
            [['usuario', 'password', 'password_repeat'], 'required', 'message' => 'El campo {attribute} es obligatorio'],
            // que el usuario no exista
            ['usuario', 'unique', 'message' => 'El usuario ya existe en el sistema'],
            ['password', 'string', 'min' => 4, 'message' => 'la contraseña debe tener al menos 6 caracteres'],
            //comparacion de contraseñas
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'operator' => '==', 'message' => 'Las contraseñas deben coincidir'],
            // validacion de captcha
            //['codigo', 'captcha', 'message' => 'No coincide el codigo mostrado'], // esto funcionaria correctamente sin AJAX
            //Con AJAX existe un bug lo corregimos con una funcion 
            ['codigo', 'codeVerify'],
            ['codigo','required','message'=>'Debes escribir algo en los codigos'],
            
            //colocar los campos que necesito que pase en la asignacion masiva
            [['password_repeat', 'password', 'usuario', 'codigo'], 'safe'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'usuario' => 'Nombre de Usuario',
            'password' => 'Contraseña',
            'password_repeat' => 'Repite la contraseña',
            'codigo' => 'Escribe los codigos que ves'
        ];
    }

    public function codeVerify($attribute) {
        /* nombre de la accion del controlador */
        $captcha_validate = new  \yii\captcha\CaptchaAction('captcha', Yii::$app->controller);
        
        
        if ($this->$attribute) {
            $code = $captcha_validate->getVerifyCode();
            if ($this->$attribute != $code) {
                $this->addError($attribute, 'Ese codigo de verificacion no es correcto');
            }
        }
        
    }

    public static function findIdentity($id) {
        return static::findOne(['id' => $id]);
    }

    public static function findByUsername($username) {
        return static::findOne(['usuario' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /* public function validatePassword($password)
      {
      return Yii::$app->security->validatePassword($password, $this->password_hash);
      } */

    public function validatePassword($password) {
        return $this->password === $password;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return null;
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return null;
    }

}
