<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Query;

use app\module\admin\models\AuthLog;
/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
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
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'username'  => 'Логин',
            'password'  => 'Пароль',
            'rememberMe'=> 'Запомнить меня',
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
        if (!$this->hasErrors()) {//Если нет ошибок в валидации
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Не верный пароль.');
            }
                                    
            /*if(!$this->getUser()){
                $this->addError($attribute, 'Неверный пароль');
            } */
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {   
        if ($this->validate()) {
            $model = new AuthLog;
            $model->status = 'login';
            $model->user = $this->user->attributes['type'];
            $model->time = time();
            $model->ip = Yii::$app->request->userIP;
            $model->save();
            
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
            //if($this->getUser()) return true;
        }else{
            $model = new AuthLog;
            $model->status = 'error';
            $model->user = $this->username.' | '.$this->password;
            $model->time = time();
            $model->ip = Yii::$app->request->userIP;
            $model->save();
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
            //$this->_user = User::findByUsername($this->username);
            /*
            $query = new Query();
            $this->_user = $query->select(['id', 'email', 'login'])
            ->from('users')
            ->where(['login' => $this->username]);*/
            
            $this->_user = UserIdentity::findByUsername($this->username);
        }

        return $this->_user;
    }
}
