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
    // Propiedad temporal para manejar la contraseña en texto plano
    public $password;

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
            [['tbl_usuarios_nombre', 'tbl_usuarios_apellido', 'tbl_usuarios_email', 'tbl_usuarios_telefono', 'tbl_usuarios_rol'], 'required'],
            [['password'], 'required', 'on' => 'create'],
            [['tbl_usuarios_created', 'tbl_usuarios_createdby'], 'safe'],
            [['tbl_usuarios_nombre', 'tbl_usuarios_apellido', 'tbl_usuarios_email', 
            'tbl_usuarios_password', 'tbl_usuarios_recoverpass', 'tbl_usuarios_auth_key', 
            'tbl_usuarios_access_token', 'tbl_usuarios_telefono'], 'string', 'max' => 100],
            ['tbl_usuarios_email', 'email'],
            ['tbl_usuarios_email', 'unique'],
            ['tbl_usuarios_rol', 'in', 'range' => ['admin', 'usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tbl_usuarios_id' => 'ID',
            'tbl_usuarios_nombre' => 'Nombre',
            'tbl_usuarios_apellido' => 'Apellido',
            'tbl_usuarios_email' => 'Email',
            'password' => 'Contraseña',
            'tbl_usuarios_telefono' => 'Teléfono',
            'tbl_usuarios_rol' => 'Rol',
            'tbl_usuarios_created' => 'Fecha de creación',
            'tbl_usuarios_createdby' => 'Creado por',
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

    /**
     * Antes de guardar el modelo
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Generar auth_key y access_token para nuevos usuarios
            if ($insert) {
                $this->tbl_usuarios_auth_key = Yii::$app->security->generateRandomString();
                $this->tbl_usuarios_access_token = Yii::$app->security->generateRandomString();
                $this->tbl_usuarios_created = date('Y-m-d H:i:s');
                $this->tbl_usuarios_createdby = !Yii::$app->user->isGuest ? Yii::$app->user->identity->tbl_usuarios_email : 'Sistema';
            }

            // Encriptar contraseña solo si es nueva o ha cambiado
            if (!empty($this->password)) {
                $this->tbl_usuarios_password = Yii::$app->security->generatePasswordHash($this->password);
            }

            return true;
        }
        return false;
    }

    /**
     * Después de guardar, asignar rol RBAC
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        
        // Asignar rol RBAC
        $auth = Yii::$app->authManager;
        
        // Si es un update, remover roles anteriores
        if (!$insert) {
            $auth->revokeAll($this->tbl_usuarios_id);
        }
        
        // Asignar nuevo rol según el campo tbl_usuarios_rol
        $role = $auth->getRole($this->tbl_usuarios_rol);
        if ($role) {
            $auth->assign($role, $this->tbl_usuarios_id);
        }
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['tbl_usuarios_access_token' => $token]);
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
        return $this->tbl_usuarios_auth_key;
    }

    /**
     * Validates the given auth key.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
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
    
    /**
     * Obtiene el rol RBAC actual del usuario
     * @return string el nombre del rol
     */
    public function getRbacRole()
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser($this->tbl_usuarios_id);
        return empty($roles) ? null : reset($roles)->name;
    }
    
    /**
     * Verifica si el usuario es administrador 
     * @return bool
     */
    public function isAdmin()
    {
        return $this->tbl_usuarios_rol === 'admin';
    }
}