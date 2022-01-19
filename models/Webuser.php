<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base;

use yii\base\Exception;


/**
 * This is the model class for table "webuser".
 *
 * @property int $userId
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $password
 * @property string $authKey
 *
 * @property Ticket[] $tickets
 */
class Webuser extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'webuser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'email', 'password', 'authKey'], 'required'],
            [['firstName', 'lastName', 'email', 'password'], 'string', 'max' => 30],
            [['authKey'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'authKey' => 'Auth Key',
        ];
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['userId' => 'userId']);
    }
	/**
	 * Returns an ID that can uniquely identify a user identity.
	 *
	 * @return int|string an ID that uniquely identifies a user identity.
	 */
	function getId() {
        return $this->userId;
	}
	
	/**
	 * Returns a key that can be used to check the validity of a given identity ID.
	 * The key should be unique for each individual user, and should be persistent
	 * so that it can be used to check the validity of the user identity.
	 * 
	 * The space of such keys should be big enough to defeat potential identity attacks.
	 * 
	 * The returned key is used to validate session and auto-login (if [[User::enableAutoLogin]] is enabled).
	 * 
	 * Make sure to invalidate earlier issued authKeys when you implement force user logout, password change and
	 * other scenarios, that require forceful access revocation for old sessions.
	 *
	 * @return null|string a key that is used to check the validity of a given identity ID.
	 */
	function getAuthKey() {
    //    throw new \yii\base\NotSupportedException();
	}
	
	/**
	 * Validates the given auth key.
	 *
	 * @param string $authKey the given auth key
	 *
	 * @return bool|null whether the given auth key is valid.
	 */
	function validateAuthKey($authKey) {
    //    throw new \yii\base\NotSupportedException();
 
	}

    public static function findIdentity($id){
      return  self::findOne($id);
    }

public static function findIdentityByAccessToken($token, $type=null)
{
  //  throw new \yii\base\NotSupportedException();
}

public static function findByUsername($email)
{
    return self::findOne(['email'=>$email]);
}

public function validatePassword($password)
{
    return $this->password === $password;
}
	
}
