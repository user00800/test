<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%authors}}`.
 */
class m220907_194815_create_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%authors}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string()->notNull(),
            'secondname' => $this->string()->notNull(),
            'middlename' => $this->string(), // отчества может не быть
            'date_birth' => $this->date()->notNull(),
            'date_death' => $this->date(),  // автор может быть жив
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%authors}}');
    }
}
