<?php

use yii\db\Migration;


/**
 * Class m180510_150418_create_tb_m_kry
 */
class m180510_150418_create_tb_m_kry extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_m_karyawan', [
            'id_karyawan' => $this->primaryKey(),
            'id_level_jabatan'=> "integer not null",
            'kode_karyawan' => ' varchar(20) not null unique',
            'nama_karyawan' => ' varchar(100) not null',
            'alamat_karyawan' => ' TEXT ',
            'tempat_lahir' =>"varchar(50)",
            'tanggal_lahir' =>"date",
            'status_karyawan' =>'varchar(20)',
            'telepon' => ' varchar(20)    null',

            'keterangan' => ' TEXT ',
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            ' FOREIGN KEY (id_level_jabatan)  REFERENCES  tb_m_level_jabatan (id_level_jabatan)  ON UPDATE CASCADE'
        ]);




    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tb_m_karyawan');
      }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180510_150418_create_tb_m_kry cannot be reverted.\n";

        return false;
    }
    */
}
