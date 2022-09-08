<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m220907_195221_create_books_table extends Migration
{
    private $tableName = '{{%books}}';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id'               => $this->primaryKey(),
            'title'            => $this->string()->notNull(),
            'author_id'        => $this->integer()->notNull(),
            'publisher'        => $this->string(),  // издательства может и не быть
            'publish_year'     => $this->smallInteger()->notNull(),
            'epigraph'         => $this->text(),
            'page_count'       => $this->smallInteger()->notNull(),
            'pickup_last_date' => $this->date(),
        ]);

        $this->createIndex('idx-author_id', $this->tableName, 'author_id');

        $this->addForeignKey(
            'fk-books-author_id',
            $this->tableName,
            'author_id',
            '{{%authors}}',
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
        $this->dropForeignKey('fk-books-author_id', $this->tableName);
        $this->dropIndex('idx-author_id', $this->tableName);

        $this->dropTable($this->tableName);
    }
}
