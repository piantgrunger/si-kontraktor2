<?php

use yii\db\Migration;

/**
 * Class m180602_083734_alter_dt_history
 */
class m180602_083734_alter_dt_history extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_dt_rab_history', 'qty', 'decimal(19,2) not null default 0 ');
        $this->addColumn('tb_dt_rab_history', 'hari_kerja', 'integer not null default 0 ');
        $this->addColumn('tb_dt_rab_history', 'status_pekerjaan', 'varchar(20)  ');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180602_083734_alter_dt_history cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180602_083734_alter_dt_history cannot be reverted.\n";

        return false;
    }
    */
}
