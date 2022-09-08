<?php

use yii\db\Migration;

/**
 * Class m220907_201310_create_books_uses_tables
 */
class m220907_201310_create_books_uses_tables extends Migration
{
    private $tableName      = '{{%books_uses}}';
    private $tableNameBooks = '{{%books}}';
    private $tableNameUsers = '{{%users}}';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id'          => $this->primaryKey(),
            'user_id'     => $this->integer()->notNull(),
            'book_id'     => $this->integer()->notNull(),
            'date_pickup' => $this->date()->notNull(),
            'date_return' => $this->date(),
        ]);

        $this->createIndex('idx-books_uses-user_id', $this->tableName, 'user_id');
        $this->createIndex('idx-books_uses-book_id', $this->tableName, 'book_id');

        $this->addForeignKey(
            'fk-books_uses-user_id',
            $this->tableName,
            'user_id',
            $this->tableNameUsers,
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-books_uses-book_id',
            $this->tableName,
            'book_id',
            $this->tableNameBooks,
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey('fk-books_uses-book_id', $this->tableName);
        $this->dropForeignKey('fk-books_uses-user_id', $this->tableName);

        $this->dropIndex('idx-books_uses-book_id', $this->tableName);
        $this->dropIndex('idx-books_uses-user_id', $this->tableName);

        $this->dropTable($this->tableName);
    }
}
