<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property int $ticketId
 * @property string $category
 * @property string $status
 * @property string $date_created
 * @property string $location
 * @property string $comments
 * @property int $userId
 *
 * @property Webuser $user
 */
class Ticket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category','status', 'location', 'comments'], 'required'],
            [['userId'], 'integer'],
            [['status'], 'string', 'max' => 25],
            [['location'], 'string', 'max' => 200],
            [['comments'], 'string', 'max' => 300],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => Webuser::className(), 'targetAttribute' => ['userId' => 'userId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ticketId' => 'Ticket ID',
            'category'=>'Category',
            'status' => 'Status',
            'date_created' => 'Date Created',
            'location' => 'Location',
            'comments' => 'Comments',
            'userId' => 'User ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Webuser::className(), ['userId' => 'userId']);
    }
}
