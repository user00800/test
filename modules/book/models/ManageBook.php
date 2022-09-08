<?php

namespace app\modules\book\models;

use Yii;

/**
 * Управление взять/вернуть книгу.
 */
class ManageBook
{
    private $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }


    public function pickup(): bool
    {
        $bookUse = new BooksUses();
        $bookUse->user_id = Yii::$app->user->id;
        $bookUse->book_id = $this->book->id;
        $bookUse->date_pickup = date('Y-m-d');

        if ($bookUse->save()) {
            $this->book->pickup_last_date = $bookUse->date_pickup;
            $this->book->save(false);

            return true;
        }

        return false;
    }

    public function return(): bool
    {
        $bookUse = $this->book->lastPickuped;
        $bookUse->date_return = date('Y-m-d');

        return $bookUse->save(false);
    }
}
