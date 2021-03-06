<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "kelas".
 *
 * @property int $id
 * @property string $nama
 */
class Kelas extends \yii\db\ActiveRecord
{

    // public $id;
    /**
     * {@inheritdoc}
     */
    
    public static function tableName()
    {
        return 'kelas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
        ];
    }
}
