<?php

use yii\db\Migration;

/**
 * Class m180603_092415_tb_dt_realisasi_pekerja
 */
class m180603_092415_tb_dt_realisasi_pekerja extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_dt_realisasi_pekerja', [
            'id_d_realisasi' => $this->primaryKey(),
            'id_realisasi' => "integer not null ",
            'id_sd_rab' => "integer not null ",
            'id_karyawan' => "integer not null ",
            'gaji' => "decimal(19,2) not null default 0",
            'sub_total' => "decimal(19,2) not null default 0",
            "FOREIGN KEY (id_realisasi) REFERENCES  tb_mt_realisasi (id_realisasi)  ON UPDATE CASCADE   ON DELETE CASCADE",
            " FOREIGN KEY (id_sd_rab)  REFERENCES  tb_sdt_rab_pekerja (id_sd_rab) ",
            "FOREIGN KEY (id_karyawan)  REFERENCES  tb_m_karyawan (id_karyawan)  "
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180603_092415_tb_dt_realisasi_pekerja cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180603_092415_tb_dt_realisasi_pekerja cannot be reverted.\n";

        return false;
    }
    */
}
