<?php

use yii\db\Migration;

/**
 * Class m180507_164249_create_tb_m_jenis_pekerjaan
 */
class m180507_164249_create_tb_m_jns_pekerjaan extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

        $this->createTable('tb_m_jenis_pekerjaan', [
            'id_jenis_pekerjaan' => $this->primaryKey(),
            'kode_jenis_pekerjaan' => ' varchar(20) not null unique',
            'nama_jenis_pekerjaan' => ' varchar(100) not null',
            'keterangan' => ' TEXT ',
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),





        ]);
    }


    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180507_164249_create_tb_m_jenis_pekerjaan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180507_164249_create_tb_m_jenis_pekerjaan cannot be reverted.\n";

        return false;
    }
    */
}
