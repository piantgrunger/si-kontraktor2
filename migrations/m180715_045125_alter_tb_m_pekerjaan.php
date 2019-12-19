<?php

use yii\db\Migration;

/**
 * Class m180715_045125_alter_tb_m_pekerjaan.
 */
class m180715_045125_alter_tb_m_pekerjaan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tb_m_pekerjaan', 'id_jenis_pekerjaan', 'integer null');
        $this->addColumn('tb_m_pekerjaan', 'id_parent_pekerjaan', 'integer null');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tb_m_pekerjaan', 'id_pekerjaan_parent');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180715_045125_alter_tb_m_pekerjaan cannot be reverted.\n";

        return false;
    }
    */
}
