<?php

use yii\db\Schema;
use yii\db\Migration;

class m240821_090845_users extends Migration
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
            '{{%users}}',
            [
                'id'=> $this->primaryKey()->unsigned(),
                'firstname'=> $this->string(32)->notNull(),
                'middlename'=> $this->string(64)->notNull(),
                'lastname'=> $this->string(64)->notNull(),
                'email'=> $this->string(64)->notNull(),
                'password'=> $this->string(120)->notNull(),
                'user_type'=> $this->string(120)->null()->defaultValue('user'),
                'auth_key'=> $this->string(100)->null()->defaultValue(null),
                'created_at'=> $this->datetime()->null()->defaultValue(null),
                'updated_at'=> $this->datetime()->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
