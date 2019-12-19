<?php

use yii\db\Migration;
use yii\db\mssql\Schema;

/**
 * Class m180507_083428_create_tb_m_material
 */
class m180507_083428_create_tb_m_material extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('tb_m_material',[
            'id_material'=>Schema::TYPE_PK,
            'kode_material'=>' varchar(20) not null unique',
            'nama_material' => ' varchar(100) not null',
            'spesifikasi' => ' varchar(100)  null',
            'satuan' => ' varchar(50) not null',
            'keterangan' => ' TEXT ',
            'created_at'=>$this->dateTime(),
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
        $this->dropTable('tb_m_material');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180507_083428_create_tb_m_material cannot be reverted.\n";

        return false;
    }
    */
}
