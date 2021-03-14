<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $nisn;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['nisn', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
        ];
    }

    public function login($data = [])
    {
        if ($this->validate()) {
            return Yii::$app->user->login($data, $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }
}
