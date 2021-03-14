<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "siswa".
 *
 * @property string $nisn
 * @property string $nis
 * @property string $nama
 * @property int $id_kelas
 * @property string $alamat
 * @property string $no_telp
 * @property int $id_spp
 * @property string $password
 */
class Siswa extends \yii\db\ActiveRecord
{
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
            [['nisn', 'nis', 'nama', 'alamat', 'no_telp', 'password'], 'required'],
            [['id_kelas'], 'integer'],
            [['alamat'], 'string'],
            // [['nisn'], 'string', 'max' => 10],
            [['nis'], 'string', 'max' => 8],
            [['nama'], 'string', 'max' => 35],
            [['no_telp'], 'string', 'max' => 13],
            [['nisn'], 'unique'],
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
            'password' => 'Password',
        ];
    }
}
