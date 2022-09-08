<?php

use yii\db\Migration;

/**
 * Class m220907_214622_add_items_to_books_uses_table
 */
class m220907_214622_add_items_to_books_uses_table extends Migration
{
    private $tableName = '{{%books_uses}}';

    private static $uses = [
        [
            'book_id'     => 1,
            'user_id'     => 1,
            'date_pickup' => '2022-04-21',
            'date_return' => '2022-04-28',
        ],
        [
            'book_id'     => 1,
            'user_id'     => 1,
            'date_pickup' => '2022-05-21',
            'date_return' => '2022-05-28',
        ],
        [
            'book_id'     => 1,
            'user_id'     => 1,
            'date_pickup' => '2022-06-21',
            'date_return' => '2022-06-28',
        ],
        [
            'book_id'     => 1,
            'user_id'     => 2,
            'date_pickup' => '2022-07-21',
            'date_return' => '2022-07-28',
        ],
        [
            'book_id'     => 1,
            'user_id'     => 2,
            'date_pickup' => '2022-08-21',
            'date_return' => '2022-08-28',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        foreach (self::$uses as $use) {
            $this->insert($this->tableName, [
                'book_id'     => $use['book_id'],
                'user_id'     => $use['user_id'],
                'date_pickup' => $use['date_pickup'],
                'date_return' => $use['date_return'],
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->db->createCommand("TRUNCATE TABLE $this->tableName RESTART IDENTITY CASCADE;");
    }
}
