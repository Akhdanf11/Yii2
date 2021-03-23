<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "level".
 *
 * @property int $id
 * @property string $nama
 */
class Level extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nama'], 'required'],
            [['id'], 'integer'],
            [['nama'], 'string', 'max' => 30],
            [['id'], 'unique'],
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
