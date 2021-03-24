<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "spp".
 *
 * @property int $id
 * @property int $nisn
 * @property int $nominal
 * @property string $created_at
 */
class Spp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nisn', 'nominal'], 'required'],
            [['nisn', 'nominal'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nisn' => 'Nisn',
            'nominal' => 'Nominal',
            'created_at' => 'Created At',
        ];
    }
}
