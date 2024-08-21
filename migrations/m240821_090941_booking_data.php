<?php

use yii\db\Schema;
use yii\db\Migration;

class m240821_090941_booking_data extends Migration
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
            '{{%booking_data}}',
            [
                'id'=> $this->primaryKey()->unsigned(),
                'hall_id'=> $this->integer()->unsigned()->notNull(),
                'user_id'=> $this->integer()->unsigned()->notNull(),
                'booking_begin'=> $this->datetime()->null()->defaultValue(null),
                'booking_end'=> $this->datetime()->null()->defaultValue(null),
                'is_booked'=> $this->tinyInteger(1)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('hall_id','{{%booking_data}}',['hall_id'],false);
        $this->createIndex('user_id','{{%booking_data}}',['user_id'],false);
        

    }

    public function safeDown()
    {
        $this->dropIndex('hall_id', '{{%booking_data}}');
        $this->dropIndex('user_id', '{{%booking_data}}');
        $this->dropIndex('hall_id_2', '{{%booking_data}}');
        $this->dropIndex('user_id_2', '{{%booking_data}}');
        $this->dropTable('{{%booking_data}}');
    }
}
