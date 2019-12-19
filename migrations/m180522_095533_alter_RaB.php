<?php

use yii\db\Migration;

/**
 * Class m180522_095533_alter_rab
 */
class m180522_095533_alter_rab extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_mt_rab', 'revisi',' varchar(100)');
        $this->addColumn('tb_mt_rab', 'file_acuan_revisi', ' varchar(100)');
        $this->addColumn('tb_mt_rab_history', 'revisi', ' varchar(100)');
        $this->addColumn('tb_mt_rab_history', 'file_acuan_revisi', ' varchar(100)');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180522_095533_alter_rab cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180522_095533_alter_rab cannot be reverted.\n";

        return false;
    }
    */
}
