<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property int $nisn
 * @property string $keluhan
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nisn', 'keluhan'], 'required'],
            [['nisn'], 'integer'],
            [['keluhan'], 'string'],
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
            'keluhan' => 'Keluhan',
        ];
    }
}
