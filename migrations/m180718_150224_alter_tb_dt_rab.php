<?php

use yii\db\Migration;

/**
 * Class m180718_150224_alter_tb_dt_rab
 */
class m180718_150224_alter_tb_dt_rab extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_dt_rab', 'level', 'integer not  null default 1');
        $this->addColumn('tb_dt_rab_history', 'level', 'integer not null default 1');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180718_150224_alter_tb_dt_rab cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180718_150224_alter_tb_dt_rab cannot be reverted.\n";

        return false;
    }
    */
}
