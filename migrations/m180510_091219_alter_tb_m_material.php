<?php

use yii\db\Migration;

/**
 * Class m180510_091219_alter_tb_m_material
 */
class m180510_091219_alter_tb_m_material extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_material',"jenis","varchar(10)");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180510_091219_alter_tb_m_material cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180510_091219_alter_tb_m_material cannot be reverted.\n";

        return false;
    }
    */
}
