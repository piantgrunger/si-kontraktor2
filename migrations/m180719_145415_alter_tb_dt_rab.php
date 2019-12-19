<?php

use yii\db\Migration;

/**
 * Class m180719_145415_alter_tb_dt_rab
 */
class m180719_145415_alter_tb_dt_rab extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_dt_rab', 'status_bayar', "varchar(10) not  null default 'belum'");
        $this->addColumn('tb_dt_rab_history', 'status_bayar', "varchar(10) not  null default 'belum'");
        $this->addColumn('tb_dt_rab', 'retensi_persen', "decimal(19,2) not  null default 0");
        $this->addColumn('tb_dt_rab_history', 'retensi_persen', "decimal(19,2) not  null default 0");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180719_145415_alter_tb_dt_rab cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180719_145415_alter_tb_dt_rab cannot be reverted.\n";

        return false;
    }
    */
}
