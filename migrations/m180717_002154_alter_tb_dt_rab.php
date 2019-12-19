<?php

use yii\db\Migration;

/**
 * Class m180717_002154_alter_tb_dt_rab.
 */
class m180717_002154_alter_tb_dt_rab extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tb_dt_rab', 'id_pekerjaan', 'integer null');
        $this->alterColumn('tb_dt_rab_history', 'id_pekerjaan', 'integer null');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180717_002154_alter_tb_dt_rab cannot be reverted.\n";

        return false;
    }
    */
}
