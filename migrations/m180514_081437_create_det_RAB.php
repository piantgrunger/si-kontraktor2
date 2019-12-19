<?php

use yii\db\Migration;

/**
 * Class m180514_081437_create_det_rab
 */
class m180514_081437_create_det_rab extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_dt_rab', [
            'id_d_rab' => $this->primaryKey(),
            'id_rab' => "integer not null ",
            'id_pekerjaan' => "integer not null ",

            'total_biaya_material' => "decimal(19,2) not null default 0",
            'total_biaya_pekerja' => "decimal(19,2) not null default 0",
            'total_biaya_peralatan' => "decimal(19,2) not null default 0",
            "FOREIGN KEY  (id_rab) REFERENCES  tb_mt_rab (id_rab)  ON UPDATE CASCADE   ON DELETE CASCADE",
            "FOREIGN KEY  (id_pekerjaan) REFERENCES  tb_m_pekerjaan (id_pekerjaan)  ON UPDATE CASCADE   ON DELETE CASCADE"


        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tb_dt_rab');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180514_081437_create_det_rab cannot be reverted.\n";

        return false;
    }
    */
}
