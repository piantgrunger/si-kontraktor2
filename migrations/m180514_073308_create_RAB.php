<?php

use yii\db\Migration;

/**
 * Class m180514_073308_create_rab
 */
class m180514_073308_create_rab extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_mt_rab', [
            'id_rab' => $this->primaryKey(),
            'id_proyek' => "integer not null ",
            'no_rab' => "varchar(50) not null unique",
            'tgl_rab' => "date not null ",
            'total_biaya_material' => "decimal(19,2) not null default 0",
             'total_biaya_pekerja' => "decimal(19,2) not null default 0",
            'total_biaya_peralatan' => "decimal(19,2) not null default 0",
            'margin' => "decimal(19,2) not null default 0",
            'dana_cadangan' => "decimal(19,2) not null default 0",
            'total_rab' => "decimal(19,2) not null default 0",

            'keterangan' => ' TEXT ',
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            "FOREIGN KEY (id_proyek) REFERENCES  tb_mt_proyek (id_proyek)  ON UPDATE CASCADE"
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tb_mt_rab');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180514_073308_create_rab cannot be reverted.\n";

        return false;
    }
    */
}
