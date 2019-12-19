<?php

use yii\db\Migration;

/**
 * Class m180612_080720_create_tb_m_rekanan.
 */
class m180612_080720_create_tb_m_rekanan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_m_rekanan', [
            'id_rekanan' => $this->primaryKey(),
            'kode_rekanan' => ' varchar(20) not null unique',
            'nama_rekanan' => ' varchar(100) not null',
            'alamat_rekanan' => ' TEXT ',

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
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180612_080720_create_tb_m_rekanan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180612_080720_create_tb_m_rekanan cannot be reverted.\n";

        return false;
    }
    */
}
