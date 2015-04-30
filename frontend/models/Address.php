<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property integer $person_id
 * @property integer $live
 * @property integer $type
 * @property string $iso
 * @property string $state
 * @property string $street
 * @property string $city
 * @property string $postal_code
 * @property string $note
 * @property integer $user_id_created
 * @property string $date_entered
 * @property string $date_updated
 * @property string $ip_created
 * @property string $ip_updated
 *
 * @property Person $person
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iso'], 'required'],
            [['person_id', 'live', 'type', 'user_id_created'], 'integer'],
            [['note'], 'string'],
            [['date_entered', 'date_updated'], 'safe'],
            [['iso'], 'string', 'max' => 2],
            [['state', 'street', 'city', 'postal_code'], 'string', 'max' => 30],
            [['ip_created', 'ip_updated'], 'string', 'max' => 50]
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if($this->isNewRecord) {
                $this->ip_created = $_SERVER['REMOTE_ADDR'];
                return true;
            } elseif(!$this->isNewRecord) {
                $this->ip_updated = $_SERVER['REMOTE_ADDR'];
                $this->date_updated = date('Y-m-d H:i:s');
                return true;
            }

        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person_id' => 'Person ID',
            'live' => 'Live',
            'type' => 'Type',
            'iso' => 'Iso',
            'state' => 'State',
            'street' => 'Street',
            'city' => 'City',
            'postal_code' => 'Postal Code',
            'note' => 'Note',
            'user_id_created' => 'User Id Created',
            'date_entered' => 'Date Entered',
            'date_updated' => 'Date Updated',
            'ip_created' => 'Ip Created',
            'ip_updated' => 'Ip Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }
}
