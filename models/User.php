<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
        return '{{%users}}';
    }

    public function rules()
    {
        return [
            [['name', 'login', 'password', 'authKey'], 'string'],
            ['login', 'unique'],
            [['name', 'login', 'password', 'authKey'], 'required'],
        ];
    }

    public static function findByLogin(string $login): ?User
    {
        if (($user = static::findOne(['login' => $login])) !== null) {
            return $user;
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     *
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password): bool
    {
        if ($password === '' || trim($this->password) === '') {
            return false;
        }

        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
