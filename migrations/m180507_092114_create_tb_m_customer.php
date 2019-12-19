<?php

use yii\db\Migration;
use yii\db\mssql\Schema;

/**
 * Class m180507_092114_create_tb_m_customer
 */
class m180507_092114_create_tb_m_customer extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('tb_m_customer', [
            'id_customer' => Schema::TYPE_PK,
            'kode_customer' => ' varchar(20) not null unique',
            'nama_customer' => ' varchar(100) not null',
            'alamat_customer' => ' TEXT ',


            'kota' => ' varchar(50)  not  null',
            'telepon' => ' varchar(20)    null',
            'fax' => ' varchar(20)    null',
            'kontak_person' => ' varchar(20)    null',

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

        $this->dropTable('tb_m_customer');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180507_092114_create_tb_m_customer cannot be reverted.\n";

        return false;
    }
    */
}
