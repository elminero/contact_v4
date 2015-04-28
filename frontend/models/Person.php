<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property integer $id
 * @property integer $live
 * @property string $last_name
 * @property string $first_name
 * @property string $middle_name
 * @property string $alias_name
 * @property integer $birth_month
 * @property integer $birth_day
 * @property integer $birth_year
 * @property string $note
 * @property integer $user_id_created
 * @property string $date_created
 * @property string $date_updated
 * @property string $ip_created
 * @property string $ip_updated
 *
 * @property Address[] $addresses
 * @property EmailAddress[] $emailAddresses
 * @property PhoneNumber[] $phoneNumbers
 * @property Picture[] $pictures
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['live', 'birth_month', 'birth_day', 'birth_year', 'user_id_created'], 'integer'],
            [['note'], 'string'],
            [['date_created', 'date_updated'], 'safe'],
//            [['ip_created'], 'required'],
            [['last_name', 'first_name', 'middle_name', 'alias_name'], 'string', 'max' => 30],
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
            'live' => 'Live',
            'last_name' => 'Last Name',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'alias_name' => 'Alias Name',
            'birth_month' => 'Birth Month',
            'birth_day' => 'Birth Day',
            'birth_year' => 'Birth Year',
            'note' => 'Note',
            'user_id_created' => 'User Id Created',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'ip_created' => 'Ip Created',
            'ip_updated' => 'Ip Updated',
        ];
    }

    /**
     * Gets the IP Address and date when creating or updating a new record
     *
     * @return true before record is created or updated
     */
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
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailAddresses()
    {
        return $this->hasMany(EmailAddress::className(), ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneNumbers()
    {
        return $this->hasMany(PhoneNumber::className(), ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPictures()
    {
        return $this->hasMany(Picture::className(), ['person_id' => 'id']);
    }


    /**
     * Get all the name with address. The same name will appear for each associated with it.
     * @return person LEFT OUTER JOIN address
     */
    public function getNamesWithAddress() {
        $sql = "SELECT person.id, person.last_name, person.first_name, person.middle_name, person.alias_name,
                address.street, address.city, address.state, address.iso, address.postal_code
                FROM person LEFT OUTER JOIN address
                ON person.id = address.person_id";

        return  \Yii::$app->db->createCommand($sql)->queryAll();
    }


}
