<?php

use yii\db\Migration;

/**
 * Class m180713_084703_alter_rab_history.
 */
class m180713_084703_alter_rab_history extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_mt_rab_history', 'nilai_kontrak', 'decimal(19,2) not null default 0');
        $this->addColumn('tb_mt_rab_history', 'nilai_real', 'decimal(19,2) not null default 0');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180713_084703_alter_rab_history cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180713_084703_alter_rab_history cannot be reverted.\n";

        return false;
    }
    */
}
