<?php

use yii\db\Migration;

/**
 * Class m180713_145020_alter_tb_mt_rab_table
 */
class m180713_145020_alter_tb_mt_rab_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
           $this->addColumn('tb_mt_rab','id_jenis_bangunan', 'integer  null   ');
          $this->addColumn('tb_mt_rab', 'nilai_kontrak', 'decimal(19,2) not null default 0');
          $this->addColumn('tb_mt_rab', 'nilai_real','decimal(19,2) not null default 0');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180713_145020_alter_tb_mt_rab_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180713_145020_alter_tb_mt_rab_table cannot be reverted.\n";

        return false;
    }
    */
}
