<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "petugas".
 *
 * @property int $id_petugas
 * @property string $username
 * @property string $password
 * @property string $nama_petugas
 * @property string $level
 */
class LoginFormPetugas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $rememberMe = true;

    public static function tableName()
    {
        return 'petugas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_petugas' => 'Id Petugas',
            'username' => 'Username',
            'password' => 'Password',
            'nama_petugas' => 'Nama Petugas',
            'level' => 'Level',
        ];
    }
    public function login($data = [])
    {
        return Yii::$app->user->login($data, 0);
    }
}
