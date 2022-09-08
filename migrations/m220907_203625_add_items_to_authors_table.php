<?php

use yii\db\Migration;

/**
 * Class m220907_203625_add_items_to_authors_table
 */
class m220907_203625_add_items_to_authors_table extends Migration
{
    private $tableName = '{{%authors}}';

    private static $authors = [
        [
            'firstname'  => 'firstname1',
            'secondname' => 'secondname1',
            'date_birth' => '1978-03-21',
            'date_death' => '2020-04-02',
        ],
        [
            'firstname'  => 'firstname2',
            'secondname' => 'secondname2',
            'middlename' => 'middlename2',
            'date_birth' => '1988-12-15',
        ],
        [
            'firstname'  => 'firstname3',
            'secondname' => 'secondname3',
            'date_birth' => '1995-07-07',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        foreach (self::$authors as $author) {
            $this->insert($this->tableName, [
                'firstname'  => $author['firstname'] ?? null,
                'secondname' => $author['secondname'] ?? null,
                'middlename' => $author['middlename'] ?? null,
                'date_birth' => $author['date_birth'] ?? null,
                'date_death' => $author['date_death'] ?? null,
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
