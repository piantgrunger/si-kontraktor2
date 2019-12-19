<?php

use yii\db\Migration;

/**
 * Class m180525_103342_create_pengerjaan
 */
class m180525_103342_create_pengerjaan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_mt_realisasi', [
            'id_realisasi' => $this->primaryKey(),
            'id_d_rab' => "integer not null   ",
            'no_realisasi' => "varchar(50) not null unique",
            'tgl_aw_realisasi' => "date not null ",
            'tgl_ak_realisasi' => "date not null ",

            'total_biaya_material' => "decimal(19,2) not null default 0",
            'total_biaya_pekerja' => "decimal(19,2) not null default 0",
            'total_biaya_peralatan' => "decimal(19,2) not null default 0",

            'keterangan' => ' TEXT ',
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            "FOREIGN KEY (id_d_rab) REFERENCES  tb_dt_rab(id_d_rab)"
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tb_mt_realisasi');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180525_103342_create_pengerjaan cannot be reverted.\n";

        return false;
    }
    */
}
