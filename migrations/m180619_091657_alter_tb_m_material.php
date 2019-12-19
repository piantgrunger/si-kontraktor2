<?php

use yii\db\Migration;

/**
 * Class m180619_091657_alter_tb_m_material
 */
class m180619_091657_alter_tb_m_material extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_material','kelompok_material','varchar(50)');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180619_091657_alter_tb_m_material cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180619_091657_alter_tb_m_material cannot be reverted.\n";

        return false;
    }
    */
}
