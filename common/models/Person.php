<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "{{%person}}".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $birthdate
 * @property int $age
 * @property string $sex
 * @property string $region
 * @property string $province
 * @property string $municipality
 * @property int $contact
 * @property string $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%person}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'birthdate', 'age', 'sex', 'region', 'province', 'municipality', 'contact', 'status'], 'required'],
            [['age', 'contact', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name', 'birthdate', 'sex', 'region', 'province', 'municipality', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'birthdate' => 'Birthdate',
            'age' => 'Age',
            'sex' => 'Sex',
            'region' => 'Region',
            'province' => 'Province',
            'municipality' => 'Municipality',
            'contact' => 'Contact',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PersonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PersonQuery(get_called_class());
    }
}
