<?php

use yii\db\Migration;

/**
 * Class m180510_160412_create_tb_mt_proyek
 */
class m180510_160412_create_tb_mt_proyek extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_mt_proyek',[
            'id_proyek' =>$this->primaryKey(),
            'id_customer' => "integer not null ",
            'no_proyek' =>"varchar(50) not null unique",
            'tgl_mulai' => "date not null ",
            'tgl_selesai' => "date not null ",
            'status_proyek' => "varchar(50) not null",

            'keterangan' => ' TEXT ',
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            "FOREIGN KEY (id_customer) REFERENCES  tb_m_customer (id_customer)  ON UPDATE CASCADE"




        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180510_160412_create_tb_mt_proyek cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180510_160412_create_tb_mt_proyek cannot be reverted.\n";

        return false;
    }
    */
}
