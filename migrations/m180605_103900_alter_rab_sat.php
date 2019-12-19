<?php

use yii\db\Migration;

/**
 * Class m180605_103900_alter_rab_sat
 */
class m180605_103900_alter_rab_sat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tb_dt_rab_history', 'qty', 'decimal(19,4)');
        $this->alterColumn('tb_dt_rab', 'qty', 'decimal(19,4)');

        $this->alterColumn('tb_sdt_rab_history_material', 'qty', 'decimal(19,4)');
        $this->alterColumn('tb_sdt_rab_material', 'qty', 'decimal(19,4)');
        $this->alterColumn('tb_sdt_rab_history_peralatan', 'qty', 'decimal(19,4)');
        $this->alterColumn('tb_sdt_rab_peralatan', 'qty', 'decimal(19,4)');

        $this->alterColumn('tb_sdt_rab_history_pekerja', 'qty', 'decimal(19,4)');
        $this->alterColumn('tb_sdt_rab_pekerja', 'qty', 'decimal(19,4)');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180605_103900_alter_rab_sat cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180605_103900_alter_rab_sat cannot be reverted.\n";

        return false;
    }
    */
}
