<?php

namespace app\models;

use Yii;

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
class TblUsuarios extends \yii\db\ActiveRecord
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
            [['tbl_usuarios_nombre', 'tbl_usuarios_apellido', 'tbl_usuarios_email', 'tbl_usuarios_password', 'tbl_usuarios_auth_key', 'tbl_usuarios_access_token', 'tbl_usuarios_telefono', 'tbl_usuarios_rol', 'tbl_usuarios_created', 'tbl_usuarios_createdby'], 'required'],
            [['tbl_usuarios_created', 'tbl_usuarios_createdby'], 'safe'],
            [['tbl_usuarios_nombre', 'tbl_usuarios_apellido', 'tbl_usuarios_email', 'tbl_usuarios_password', 'tbl_usuarios_recoverpass', 'tbl_usuarios_auth_key', 'tbl_usuarios_access_token', 'tbl_usuarios_telefono', 'tbl_usuarios_rol'], 'string', 'max' => 100],
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

}
