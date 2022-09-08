<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m220907_194814_create_users_table extends Migration
{
    private $tableName = '{{%users}}';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id'       => $this->primaryKey(),
            'name'     => $this->string()->notNull(),
            'login'    => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'authKey'  => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
