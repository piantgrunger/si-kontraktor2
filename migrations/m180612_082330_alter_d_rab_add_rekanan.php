<?php

use yii\db\Migration;

/**
 * Class m180612_082330_alter_d_rab_add_rekanan.
 */
class m180612_082330_alter_d_rab_add_rekanan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_dt_rab', 'id_rekanan', 'integer');

        $this->addColumn('tb_dt_rab_history', 'id_rekanan', 'integer');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180612_082330_alter_d_rab_add_rekanan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180612_082330_alter_d_rab_add_rekanan cannot be reverted.\n";

        return false;
    }
    */
}
