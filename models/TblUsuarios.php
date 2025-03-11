<?php

namespace app\models;
use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "tbl_usuarios".
 *
 * @property int $tbl_usuarios_id
 * @property string $tbl_usuarios_nombre
 * @property string $tbl_usuarios_apellido
 * @property string $tbl_usuarios_email
 * @property string $tbl_usuarios_password
 * @property string|null $tbl_usuarios_recoverpass
 * @property string $tbl_usuarios_auth_key
 * @property string $tbl_usuarios_access_token
 * @property string $tbl_usuarios_telefono
 * @property string $tbl_usuarios_rol
 * @property string $tbl_usuarios_created
 * @property string $tbl_usuarios_createdby
 */
class TblUsuarios extends ActiveRecord implements IdentityInterface
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tbl_usuarios_recoverpass'], 'default', 'value' => null],
            [['tbl_usuarios_nombre', 'tbl_usuarios_apellido', 'tbl_usuarios_email', 'tbl_usuarios_password',
             'tbl_usuarios_auth_key', 'tbl_usuarios_access_token', 'tbl_usuarios_telefono', 'tbl_usuarios_rol', 
             'tbl_usuarios_created'], 'required'],
            [['tbl_usuarios_created', 'tbl_usuarios_createdby'], 'safe'],
            [['tbl_usuarios_nombre', 'tbl_usuarios_apellido', 'tbl_usuarios_email', 
            'tbl_usuarios_password', 'tbl_usuarios_recoverpass', 'tbl_usuarios_auth_key', 
            'tbl_usuarios_access_token', 'tbl_usuarios_telefono', 'tbl_usuarios_rol'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tbl_usuarios_id' => 'Tbl Usuarios ID',
            'tbl_usuarios_nombre' => 'Tbl Usuarios Nombre',
            'tbl_usuarios_apellido' => 'Tbl Usuarios Apellido',
            'tbl_usuarios_email' => 'Tbl Usuarios Email',
            'tbl_usuarios_password' => 'Tbl Usuarios Password',
            'tbl_usuarios_recoverpass' => 'Tbl Usuarios Recoverpass',
            'tbl_usuarios_auth_key' => 'Tbl Usuarios Auth Key',
            'tbl_usuarios_access_token' => 'Tbl Usuarios Access Token',
            'tbl_usuarios_telefono' => 'Tbl Usuarios Telefono',
            'tbl_usuarios_rol' => 'Tbl Usuarios Rol',
            'tbl_usuarios_created' => 'Tbl Usuarios Created',
            'tbl_usuarios_createdby' => 'Tbl Usuarios Createdby',
        ];
    }

      /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne(['tbl_usuarios_id' => $id]);
    }
 public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Solo hash la contraseña si es nueva o ha cambiado
            if (!empty($this->tbl_usuarios_password)) {
                try {
                    $this->tbl_usuarios_password = Yii::$app->security->generatePasswordHash($this->tbl_usuarios_password);
                } catch (\Exception $e) {
                    Yii::error("Error al generar hash de contraseña: " . $e->getMessage());
                    return false;
                }
            }
            return true;
        }
        return false;
    }
    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null; // No implementamos tokens por ahora
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->tbl_usuarios_id;
    }

    /**
     * Returns a key that can be used to verify the user identity.
     * @return string a key that is used to check the validity of a given identity ID.
     */
    public function getAuthKey()
    {
        return null; // Implementar si se necesita "remember me"
    }

    /**
     * Validates the given auth key.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     */
    public function validateAuthKey($authKey)
    {
        return false; // Implementar si se necesita "remember me"
    }

    /**
     * Validates password
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->tbl_usuarios_password);
    }

    /**
     * Finds user by email
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['tbl_usuarios_email' => $email]);
    }
}
