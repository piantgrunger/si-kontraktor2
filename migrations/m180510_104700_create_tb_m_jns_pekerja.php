<?php

use yii\db\Migration;

/**
 * Class m180510_104700_create_tb_m_jns_pekerja
 */
class m180510_104700_create_tb_m_jns_pekerja extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_m_level_jabatan', [
            'id_level_jabatan' => $this->primaryKey(),
            'kode_level_jabatan' => ' varchar(20) not null unique',
            'nama_level_jabatan' => ' varchar(100) not null',
            'keterangan' => ' TEXT ',
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),





        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180510_104700_create_tb_m_jns_pekerja cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180510_104700_create_tb_m_jns_pekerja cannot be reverted.\n";

        return false;
    }
    */
}
