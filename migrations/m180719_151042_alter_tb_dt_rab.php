<?php

use yii\db\Migration;

/**
 * Class m180719_151042_alter_tb_dt_rab
 */
class m180719_151042_alter_tb_dt_rab extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_dt_rab', 'retensi_rp', "decimal(19,2) not  null default 0");
        $this->addColumn('tb_dt_rab_history', 'retensi_rp', "decimal(19,2) not  null default 0");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180719_151042_alter_tb_dt_rab cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180719_151042_alter_tb_dt_rab cannot be reverted.\n";

        return false;
    }
    */
}
