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
class Siswa extends \yii\db\ActiveRecord
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
            [['nisn', 'nis', 'nama', 'id_kelas', 'id_kelas', 'alamat', 'password'], 'required'],
            [['nisn'], 'number'],
            [['nisn', 'id_kelas', 'id_jurusan', 'no_telp'], 'integer'],
            [['nama','nis', 'alamat'], 'string'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],

            ['nisn', 'required', 'message' => 'NISN Tidak Boleh Kosong'],
            ['nisn', 'unique', 'targetClass' => '\common\models\SiswaLogin', 'message' => 'NISN Sudah Terdaftar'],
            ['nisn', 'number', 'message' => 'NISN Harus Angka'],
            ['nisn', 'string', 'min' => 10, 'max' => 10],

            ['telp', 'number', 'message' => 'NO Telpon Harus Angka'],

            ['nama', 'required', 'message' => 'Nama Tidak Boleh Kosong'],
            ['email', 'unique', 'targetClass' => '\common\models\SiswaLogin', 'message' => 'Nama Sudah Terdaftar'],

            ['password', 'required', 'message' => 'Password Tidak Boleh Kosong'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['repeat_password', 'required', 'message' => 'Repassword Tidak Boleh Kosong'],
            ['repeat_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Password Tidak Cocok'],
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
