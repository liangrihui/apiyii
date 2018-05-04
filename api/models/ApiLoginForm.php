<?php
namespace api\models;

use Yii;
use yii\base\Model;
use common\models\Adminuser;

/**
 * Login form
 */
class ApiLoginForm extends Model
{
    public $username;
    public $password;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
           
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return ['username' => '用户名或者邮箱',
                'password' => '密码',
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
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '用户名或密码不正确.');
            }
        }
    }
 
    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
     public function login()
    {
        if ($this->validate()) {
            
            $accessToken = $this->_user->generateAccessToken();
            $this->_user->expire_at = time()+3600*24*7;
            $this->_user->save();
            Yii::$app->user->login($this->_user,3600*7*24);
            return $accessToken;
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Adminuser::findByUsername($this->username);
        }

        return $this->_user;
    }
    
}
