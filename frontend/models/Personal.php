<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "siswa".
 *
 * @property int $nisn
 * @property string|null $nis
 * @property string|null $nama
 * @property string|null $password
 * @property int|null $id_kelas
 * @property int|null $id_jurusan
 * @property string|null $alamat
 * @property int|null $no_telp
 * @property int|null $id_spp
 */
class Personal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $id_skill;
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
            [['nisn'], 'required'],
            [['nisn', 'id_kelas', 'id_jurusan', 'no_telp', 'id_spp'], 'integer'],
            [['nama', 'password', 'alamat'], 'string'],
            [['nis'], 'number'],
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
            'password' => 'Password',
            'id_kelas' => 'Id Kelas',
            'id_jurusan' => 'Id Jurusan',
            'alamat' => 'Alamat',
            'no_telp' => 'No Telp',
            'id_spp' => 'Id Spp',
        ];
    }
}
