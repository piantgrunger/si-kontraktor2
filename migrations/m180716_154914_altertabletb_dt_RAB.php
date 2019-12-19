<?php

use yii\db\Migration;

/**
 * Class m180716_154914_altertabletb_dt_RAB
 */
class m180716_154914_altertabletb_dt_RAB extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $this->addColumn('tb_dt_rab', 'id_jenis_pekerjaan', 'integer');
        $this->addColumn('tb_dt_rab_history', 'id_jenis_pekerjaan', 'integer');
        $this->addColumn('tb_dt_rab', 'nilai_pagu', 'decimal(19,2)');
        $this->addColumn('tb_dt_rab_history', 'nilai_pagu', 'decimal(19,2)');
        
     }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tb_dt_rab', 'id_jenis_pekerjaan');
        $this->dropColumn('tb_dt_rab_history', 'id_jenis_pekerjaan');
        $this->dropColumn('tb_dt_rab', 'nilai_pagu');
        $this->dropColumn('tb_dt_rab_history', 'nilai_pagu');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180716_154914_altertabletb_dt_RAB cannot be reverted.\n";

        return false;
    }
    */
}
