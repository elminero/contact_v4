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
                $this->live = 1;
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
            'iso' => 'Country',
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

    public function setAddressLiveToZero ($id)
    {
        $sql = "UPDATE address SET live = 0 WHERE id = " . $id;
        $qResult =  \Yii::$app->db->createCommand($sql)->execute();
    }

    public function getPersonIdByAddressId ($id)
    {
        $sql = "SELECT person_id FROM address WHERE id = " . $id;
        $qResult =  \Yii::$app->db->createCommand($sql)->queryOne();

        return $qResult['person_id'];
    }


    public function getCountries()
    {
        $sql = "SELECT iso, country FROM country;";

        $qResult =  \Yii::$app->db->createCommand($sql)->queryAll();

        $countries=[];

        foreach ($qResult as $value) {
            $countries[$value['iso']] = $value['country'];
        }

        return $countries;

    }


    public function getState($id) {

        $sql = "SELECT subdivision FROM subdivision WHERE iso = '" . $id . "'";

        $qResult =  \Yii::$app->db->createCommand($sql)->queryAll();

        $data=[];

        foreach ($qResult as $value) {
            $data[$value['subdivision']] = $value['subdivision'];
        }

        return $data;
    }


    public function getCity()
    {
        $sql = "SELECT city FROM us_zip_code
                WHERE zip_code_type = 'STANDARD'
                AND decommisioned_ = 'false' AND state = 'CA'
                LIMIT 500";

        $qResult =  \Yii::$app->db->createCommand($sql)->queryAll();

        $data=[];

        foreach ($qResult as $value) {
            $data[$value['city']] = $value['city'];
        }

        return $data;

    }


    /*
     *
     * CREATE TABLE us_zip_code(
  id INTEGER(5) NOT NULL PRIMARY KEY
, zip_code INTEGER(5)
, zip_code_type VARCHAR(8)
, city VARCHAR(28)
, state VARCHAR(2)
, location_type VARCHAR(14)
, latitude NUMERIC(6,2)
, longitude NUMERIC(7,2)
, location VARCHAR(52)
, decommisioned_ VARCHAR(5)
);

select * from us_zip_code where zip_code = 12401;
select * from us_zip_code where city = 'WOODSTOCK';
     *
     *
     */



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }
}
