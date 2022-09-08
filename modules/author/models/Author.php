<?php

namespace app\modules\author\models;

use app\modules\book\models\Book;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "authors".
 *
 * @property int         $id
 * @property string      $firstname
 * @property string      $secondname
 * @property string|null $middlename
 * @property string      $date_birth
 * @property string|null $date_death
 *
 * @property-read string $fullName
 * @property Book[]      $books
 */
class Author extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'secondname', 'date_birth'], 'required'],
            [['date_birth', 'date_death'], 'safe'],
            [['firstname', 'secondname', 'middlename'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('app', 'ID'),
            'firstname'  => Yii::t('app', 'Firstname'),
            'secondname' => Yii::t('app', 'Secondname'),
            'middlename' => Yii::t('app', 'Middlename'),
            'date_birth' => Yii::t('app', 'Date Birth'),
            'date_death' => Yii::t('app', 'Date Death'),
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::class, ['author_id' => 'id']);
    }

    public function getFullName(): string
    {
        return "$this->secondname $this->firstname $this->middlename";
    }
}
