<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "siswa".
 *
 * @property int $nisn
 * @property int $nis
 * @property string $nama
 * @property int $id_kelas
 * @property string $alamat
 * @property int|null $no_telp
 * @property int|null $id_spp
 */
class ChangePassword extends \yii\db\ActiveRecord
{
    public $password_repeat;
    public $telp;
    public $email;
    public $repeat_password;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nisn' => 'Nisn',
            'nis' => 'Nis',
            'nama' => 'Nama',
            'id_kelas' => 'Id Kelas',
            'alamat' => 'Alamat',
            'no_telp' => 'No Telp',
            'id_spp' => 'Id Spp',
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
