<?php

use yii\db\Migration;

/**
 * Class m180701_164742_create_view
 */
class m180701_164742_create_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("create view vw_progress_realisasi
as

select id_rab,tgl_ak_realisasi,(select sum(progress) from (
select mr.id_rab, tgl_ak_realisasi,(dr.total_rab/mr.total_rab)*DATEDIFF(tgl_aw_realisasi,tgl_ak_realisasi)/dr.hari_kerja*100 as progress from tb_mt_realisasi m
left outer join tb_dt_rab dr on dr.id_d_rab=m.id_d_rab
 left outer join tb_mt_rab mr on mr.id_rab=m.id_rab
)realisasi1    where tgl_ak_realisasi<=realisasi.tgl_ak_realisasi and id_rab=realisasi.id_rab) as progress
from
(
select tgl_ak_realisasi,mr.id_rab,(dr.total_rab/mr.total_rab)*DATEDIFF(tgl_aw_realisasi,tgl_ak_realisasi)/dr.hari_kerja*100 as progress from tb_mt_realisasi m
left outer join tb_dt_rab dr on dr.id_d_rab=m.id_d_rab
 left outer join tb_mt_rab mr on mr.id_rab=m.id_rab
)realisasi
");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180701_164742_create_view cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180701_164742_create_view cannot be reverted.\n";

        return false;
    }
    */
}
