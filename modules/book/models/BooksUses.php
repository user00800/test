<?php

namespace app\modules\book\models;

use app\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "books_uses".
 *
 * @property int $id
 * @property int $user_id
 * @property int $book_id
 * @property string $date_pickup
 * @property string $date_return
 *
 * @property Book $book
 * @property User $user
 */
class BooksUses extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books_uses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'book_id', 'date_pickup'], 'required'],
            [['user_id', 'book_id'], 'default', 'value' => null],
            [['user_id', 'book_id'], 'integer'],
            [['date_pickup', 'date_return'], 'safe'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'book_id' => Yii::t('app', 'Book ID'),
            'date_pickup' => Yii::t('app', 'Date Pickup'),
            'date_return' => Yii::t('app', 'Date Return'),
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
