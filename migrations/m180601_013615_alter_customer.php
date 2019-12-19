<?php

use yii\db\Migration;

/**
 * Class m180601_013615_alter_customer
 */
class m180601_013615_alter_customer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->alterColumn('tb_m_customer' ,'kontak_person', $this->string(50));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180601_013615_alter_customer cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180601_013615_alter_customer cannot be reverted.\n";

        return false;
    }
    */
}
