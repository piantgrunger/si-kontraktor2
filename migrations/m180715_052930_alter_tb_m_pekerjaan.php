<?php

use yii\db\Migration;

/**
 * Class m180715_052930_alter_tb_m_pekerjaan.
 */
class m180715_052930_alter_tb_m_pekerjaan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_pekerjaan', 'level', 'integer not null default 1');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //   $this->dropColumn('tb_m_pekerjaan', 'level');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180715_052930_alter_tb_m_pekerjaan cannot be reverted.\n";

        return false;
    }
    */
}
