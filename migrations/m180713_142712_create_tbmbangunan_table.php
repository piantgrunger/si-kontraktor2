<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbmbangunan`.
 */
class m180713_142712_create_tbmbangunan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $this->createTable('tb_m_jenis_bangunan', [
            'id_jenis_bangunan' => $this->primaryKey(),
            'kode_jenis_bangunan' => 'Varchar(50) not null unique',

            'nama_jenis_bangunan' => 'Varchar(100) not null unique',
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
        
        $this->addColumn('tb_mt_rab_history', 'id_jenis_bangunan', 'integer  null  ');
   
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tb_m_jenis_bangunan');
    }
}
