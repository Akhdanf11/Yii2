<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form
 */
class PasswordReset extends Model
{
    public $password;
    public $password_2;
    public $repeat_password;
    
    public function tableName(){
        return false;
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password_2'], 'required', 'message' => 'Password Baru Tidak Boleh Kosong'],
            ['password_2', 'string', 'min' => 8, 'tooShort' => 'Password Baru Terlalu Pendek' ],
            
            [['password'], 'required', 'message' => 'Password Tidak Boleh Kosong'],
            
            [['repeat_password'], 'compare', 'compareAttribute' => 'password_2', 'message' => 'Password Tidak Cocok'],
            [['repeat_password'], 'required', 'message' => 'RePassword Tidak Boleh Kosong']
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    
}
