<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "email_address".
 *
 * @property integer $id
 * @property integer $person_id
 * @property integer $live
 * @property integer $type
 * @property string $email
 * @property string $note
 * @property integer $user_id_created
 * @property string $date_entered
 * @property string $date_updated
 * @property string $ip_created
 * @property string $ip_updated
 *
 * @property Person $person
 */
class EmailAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'email', 'ip_created'], 'required'],
            [['person_id', 'live', 'type', 'user_id_created'], 'integer'],
            [['note'], 'string'],
            [['date_entered', 'date_updated'], 'safe'],
            [['email'], 'string', 'max' => 60],
            [['ip_created', 'ip_updated'], 'string', 'max' => 50]
        ];
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
            'email' => 'Email',
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
