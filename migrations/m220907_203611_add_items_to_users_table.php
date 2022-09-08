<?php

use yii\db\Migration;

/**
 * Class m220907_203611_add_items_to_users_table
 */
class m220907_203611_add_items_to_users_table extends Migration
{
    private $tableName = '{{%users}}';

    private static $users = [
        [
            'name'     => 'name1',
            'login'    => 'login1',
            'password' => '111',
            'authKey'  => '111',
        ],
        [
            'name'     => 'name2',
            'login'    => 'login2',
            'password' => '222',
            'authKey'  => '222',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        foreach (self::$users as $user) {
            $this->insert($this->tableName, [
                'name'     => $user['name'],
                'login'    => $user['login'],
                'password' => Yii::$app->security->generatePasswordHash($user['password']),
                'authKey'  => $user['authKey'],
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
