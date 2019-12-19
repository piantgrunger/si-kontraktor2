<?php

use yii\db\Migration;

/**
 * Class m180519_123514_alter
 */
class m180519_123514_alter extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $this->addColumn('tb_sdt_rab_material','harga', "decimal(19,2) not null default 0");
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
        echo "m180519_123514_alter cannot be reverted.\n";

        return false;
    }
    */
}
