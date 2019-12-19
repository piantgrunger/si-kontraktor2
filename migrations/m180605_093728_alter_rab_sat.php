<?php

use yii\db\Migration;

/**
 * Class m180605_093728_alter_rab_sat
 */
class m180605_093728_alter_rab_sat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_dt_rab', 'satuan', 'varchar(50)');
        $this->addColumn('tb_dt_rab_history', 'satuan', 'varchar(50)');
        $this->addColumn('tb_dt_rab', 'total_rab', 'decimal(19,2)');
        $this->addColumn('tb_dt_rab_history', 'total_rab', 'decimal(19,2)');

        $this->addColumn('tb_sdt_rab_material', 'satuan', 'varchar(50)');
        $this->addColumn('tb_sdt_rab_history_material', 'satuan', 'varchar(50)');
        $this->addColumn('tb_sdt_rab_peralatan', 'satuan', 'varchar(50)');
        $this->addColumn('tb_sdt_rab_history_peralatan', 'satuan', 'varchar(50)');

        $this->addColumn('tb_sdt_rab_pekerja', 'satuan', 'varchar(50)');
        $this->addColumn('tb_sdt_rab_history_pekerja', 'satuan', 'varchar(50)');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180605_093728_alter_rab_sat cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180605_093728_alter_rab_sat cannot be reverted.\n";

        return false;
    }
    */
}
