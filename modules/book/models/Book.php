<?php

namespace app\modules\book\models;

use app\models\User;
use app\modules\author\models\Author;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "books".
 *
 * @property int                 $id
 * @property string              $title
 * @property int                 $author_id
 * @property string|null         $publisher
 * @property int                 $publish_year
 * @property string|null         $epigraph
 * @property int                 $page_count
 * @property string|null         $pickup_last_date
 *
 * @property Author              $author
 * @property-read mixed          $users
 * @property-read null|BooksUses $lastPickuped
 * @property-read bool           $isPickuped
 * @property BooksUses[]         $booksUses
 */
class Book extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'author_id', 'publish_year', 'page_count'], 'required'],
            [['author_id', 'publish_year', 'page_count'], 'default', 'value' => null],
            [['author_id', 'publish_year', 'page_count'], 'integer'],
            [['epigraph'], 'string'],
            [['pickup_last_date'], 'safe'],
            [['title', 'publisher'], 'string', 'max' => 255],
            [
                ['author_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Author::class,
                'targetAttribute' => ['author_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'               => Yii::t('app', 'ID'),
            'title'            => Yii::t('app', 'Title'),
            'author_id'        => Yii::t('app', 'Author ID'),
            'publisher'        => Yii::t('app', 'Publisher'),
            'publish_year'     => Yii::t('app', 'Publish Year'),
            'epigraph'         => Yii::t('app', 'Epigraph'),
            'page_count'       => Yii::t('app', 'Page Count'),
            'pickup_last_date' => Yii::t('app', 'Pickup Last Date'),
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return ActiveQuery
     */
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    public function getUsers(): ActiveQuery
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])
            ->via('booksUses')
        ;
    }

    /**
     * Gets query for [[BooksUses]].
     *
     * @return ActiveQuery
     */
    public function getBooksUses(): ActiveQuery
    {
        return $this->hasMany(BooksUses::class, ['book_id' => 'id']);
    }

    public function getLastPickuped(): ?BooksUses
    {
        /** @var BooksUses|null $last */
        $last = $this->getBooksUses()->orderBy(['date_pickup' => SORT_DESC, 'id' => SORT_DESC])->one();

        return $last;
    }

    public function getIsPickuped(): bool
    {
        if (($lastPickup = $this->lastPickuped) !== null) {
            return empty($lastPickup->date_return);
        }

        return false;
    }
}
