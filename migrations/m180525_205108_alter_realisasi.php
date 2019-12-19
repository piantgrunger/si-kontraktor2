<?php

use yii\db\Migration;

/**
 * Class m180525_205108_alter_realisasi
 */
class m180525_205108_alter_realisasi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
          $this->addColumn('tb_mt_realisasi',
            'id_rab' , "integer not null ");
            $this->addForeignKey('fk11', 'tb_mt_realisasi', 'id_rab', 'tb_mt_rab', 'id_rab' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180525_205108_alter_realisasi cannot be reverted.\n";

        return false;
    }
    */
}
