<?php

use yii\db\Migration;

/**
 * Class m180515_094015_tb_sdt_rab_bahan
 */
class m180515_094015_tb_sdt_rab_bahan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_sdt_rab_material', [
            'id_sd_rab' => $this->primaryKey(),
            'id_d_rab' => "integer not null ",
            'id_material' => "integer not null ",

            'qty' => "decimal(19,2) not null default 0",
            'sub_total' => "decimal(19,2) not null default 0",
            "FOREIGN KEY (id_d_rab) REFERENCES  tb_dt_rab (id_d_rab)  ON UPDATE CASCADE   ON DELETE CASCADE",
            "FOREIGN KEY (id_material)  REFERENCES  tb_m_material (id_material)  ON UPDATE CASCADE   ON DELETE CASCADE",

        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tb_sdt_rab_material');
     }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180515_094015_tb_sdt_rab_bahan cannot be reverted.\n";

        return false;
    }
    */
}
