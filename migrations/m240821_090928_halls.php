<?php

use yii\db\Schema;
use yii\db\Migration;

class m240821_090928_halls extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%halls}}',
            [
                'id'=> $this->primaryKey()->unsigned(),
                'hall_name'=> $this->string(128)->notNull(),
                'hall_description'=> $this->text()->null()->defaultValue(null),
                'capacity'=> $this->integer()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%halls}}');
    }
}
