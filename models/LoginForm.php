<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            
            if (!$user) {
                $this->addError($attribute, 'Usuario o contraseña incorrectos.');
                return;
            }

            try {
                if (!$user->validatePassword($this->password)) {
                    $this->addError($attribute, 'Usuario o contraseña incorrectos.');
                }
            } catch (\Exception $e) {
                Yii::error("Error en validación de contraseña: " . $e->getMessage());
                $this->addError($attribute, 'Error al validar credenciales. Por favor intente nuevamente.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            try {
                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
            } catch (\Exception $e) {
                Yii::error("Error en login: " . $e->getMessage());
                $this->addError('password', 'Error al iniciar sesión. Por favor intente nuevamente.');
                return false;
            }
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = TblUsuarios::findByEmail($this->email);
        }

        return $this->_user;
    }
}
