<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "picture".
 *
 * @property integer $id
 * @property integer $person_id
 * @property integer $live
 * @property integer $avatar
 * @property string $file_name
 * @property string $caption
 * @property string $copyright
 * @property integer $user_id_created
 * @property string $date_entered
 * @property string $date_updated
 * @property string $ip_created
 * @property string $ip_updated
 *
 * @property Person $person
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'picture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'file_name', 'ip_created'], 'required'],
            [['person_id', 'live', 'avatar', 'user_id_created'], 'integer'],
            [['caption', 'copyright'], 'string'],
            [['date_entered', 'date_updated'], 'safe'],
            [['file_name'], 'string', 'max' => 60],
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
            'avatar' => 'Avatar',
            'file_name' => 'File Name',
            'caption' => 'Caption',
            'copyright' => 'Copyright',
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


    public function getPersonIdByPictureId ($id)
    {
        $sql = "SELECT person_id FROM picture WHERE id = " . $id;
        $qResult = \Yii::$app->db->createCommand($sql)->queryOne();

        return $qResult['person_id'];
    }


    public function getNextPicture($id)
    {
        $personId = self::getPersonIdByPictureId($id);

        $sql = "SELECT id FROM picture WHERE person_id= " . $personId . " AND id > " . $id . " AND live=1";
        $qResult =\Yii::$app->db->createCommand($sql)->queryOne();

        if($qResult) {
            $next = $qResult['id'];
        } else {
            $sql = "SELECT MIN(id) AS id  FROM picture WHERE person_id =  " . $personId;
            $qResult =\Yii::$app->db->createCommand($sql)->queryOne();
            $next = $qResult['id'];
        }

        return $next;
    }


    public function getPreviousPicture($id)
    {
        $personId = self::getPersonIdByPictureId($id);

        $sql = "SELECT id FROM picture WHERE person_id= " . $personId . " AND id < " . $id . " AND live=1 ORDER BY id DESC";
        $qResult =\Yii::$app->db->createCommand($sql)->queryOne();

        if($qResult) {
            $previous = $qResult['id'];
        } else {
            $sql = "SELECT MAX(id) AS id  FROM picture WHERE person_id =  " . $personId;
            $qResult =\Yii::$app->db->createCommand($sql)->queryOne();
            $previous = $qResult['id'];
        }

        return $previous;
    }

}
