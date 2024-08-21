<?php

use yii\db\Schema;
use yii\db\Migration;

class m240821_090942_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_booking_data_user_id',
            '{{%booking_data}}','user_id',
            '{{%users}}','id',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_booking_data_hall_id',
            '{{%booking_data}}','hall_id',
            '{{%halls}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_booking_data_user_id', '{{%booking_data}}');
        $this->dropForeignKey('fk_booking_data_hall_id', '{{%booking_data}}');
    }
}
