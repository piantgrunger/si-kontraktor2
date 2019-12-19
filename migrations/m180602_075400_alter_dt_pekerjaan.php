<?php

use yii\db\Migration;

/**
 * Class m180602_075400_alter_dt_pekerjaan
 */
class m180602_075400_alter_dt_pekerjaan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
          $this->addColumn('tb_dt_rab','qty','decimal(19,2) not null default 0 ');
        $this->addColumn('tb_dt_rab', 'hari_kerja', 'integer not null default 0 ');
        $this->addColumn('tb_dt_rab', 'status_pekerjaan', 'varchar(20)  ');
        $this->addColumn('tb_mt_realisasi', 'qty', 'decimal(19,2) not null default 0 ');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180602_075400_alter_dt_pekerjaan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180602_075400_alter_dt_pekerjaan cannot be reverted.\n";

        return false;
    }
    */
}
