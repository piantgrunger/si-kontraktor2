
<?php

use yii\db\Migration;

/**
 * Class m180525_091626_alter_RAB
 */
class m180525_091626_alter_RAB extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('tb_mt_rab', 'revisi');
        $this->dropColumn('tb_mt_rab_history','revisi');
        $this->addColumn('tb_mt_rab', 'tgl_revisi', 'date');
        $this->addColumn('tb_mt_rab_history', 'tgl_revisi', 'date');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180525_091626_alter_RAB cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180525_091626_alter_RAB cannot be reverted.\n";

        return false;
    }
    */
}
