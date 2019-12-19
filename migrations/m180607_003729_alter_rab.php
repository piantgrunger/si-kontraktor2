<?php

use yii\db\Migration;

/**
 * Class m180607_003729_alter_rab
 */
class m180607_003729_alter_rab extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_mt_rab', 'ppn', 'decimal(19,2)');
        $this->addColumn('tb_mt_rab', 'ppn_rp', 'decimal(19,2)');

        $this->addColumn('tb_mt_rab_history', 'ppn', 'decimal(19,2)');
        $this->addColumn('tb_mt_rab_history', 'ppn_rp', 'decimal(19,2)');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180607_003729_alter_rab cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180607_003729_alter_rab cannot be reverted.\n";

        return false;
    }
    */
}
