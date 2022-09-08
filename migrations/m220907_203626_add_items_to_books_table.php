<?php

use yii\db\Migration;

/**
 * Class m220907_203626_add_items_to_books_table
 */
class m220907_203626_add_items_to_books_table extends Migration
{
    private $tableName = '{{%books}}';

    private static $books = [
        [
            'author_id'    => 1,
            'epigraph'     => 'epigraph1',
            'page_count'   => 100,
            'publisher'    => 'publisher1',
            'publish_year' => 2001,
            'title'        => 'book1',
        ],
        [
            'author_id'    => 2,
            'epigraph'     => 'epigraph2',
            'page_count'   => 200,
            'publisher'    => 'publisher2',
            'publish_year' => 2005,
            'title'        => 'book2',
        ],
        [
            'author_id'    => 1,
            'epigraph'     => 'epigraph3',
            'page_count'   => 300,
            'publisher'    => 'publisher3',
            'publish_year' => 2008,
            'title'        => 'book3',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        foreach (self::$books as $book) {
            $this->insert($this->tableName, [
                'author_id'    => $book['author_id'],
                'epigraph'     => $book['epigraph'],
                'page_count'   => $book['page_count'],
                'publisher'    => $book['publisher'],
                'publish_year' => $book['publish_year'],
                'title'        => $book['title'],
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
