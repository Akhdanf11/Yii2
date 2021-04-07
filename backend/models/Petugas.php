<?php

namespace backend\models;

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
class Petugas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $password_repeat;    
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
            [['username', 'password', 'nama_petugas', 'level'], 'required'],
            [['password', 'level'], 'string'],
            [['username'], 'string', 'max' => 25],
            [['nama_petugas'], 'string', 'max' => 35],
            [['instagram'], 'string', 'max' => 35],
            [['whatsapp'], 'string'],
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
}
