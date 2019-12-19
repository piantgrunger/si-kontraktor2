<?php

use yii\db\Migration;

/**
 * Class m180603_104047_create_view_realisasi_detail
 */
class m180603_104047_create_view_realisasi_detail extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $this->execute("CREATE VIEW vw_realisasi_details
as

select no_rab,tgl_rab,d.id_d_rab,kode_pekerjaan,nama_pekerjaan,qty,hari_kerja,(d.total_biaya_material+d.total_biaya_material+d.total_biaya_pekerja) as Total_rp,SUM(coalesce(Qty_realisasi,0)) as qty_realisasi,
sum(coalesce(hari_kerja_realisasi,0)) as hari_kerja_realisasi,
sum(coalesce(total_rp_realisasi,0)) as total_rp_realisasi

  from tb_dt_rab d
inner join tb_mt_rab m on m.id_rab = d.id_rab
inner join tb_m_pekerjaan p on p.id_pekerjaan=d.id_pekerjaan
left outer join (
select d.id_rab,d.id_d_rab,id_pekerjaan,m.qty as Qty_realisasi,
datediff(tgl_aw_realisasi,tgl_ak_realisasi) as hari_kerja_realisasi,(m.total_biaya_material+m.total_biaya_material+m.total_biaya_pekerja) as Total_rp_realisasi  from tb_mt_realisasi  m
left outer join tb_dt_rab d on m.id_d_rab = d.id_d_rab

) R
on R.id_d_rab=d.id_d_rab
group by no_rab,tgl_rab,d.id_d_rab,kode_pekerjaan,nama_pekerjaan,qty,hari_kerja,(d.total_biaya_material+d.total_biaya_material+d.total_biaya_pekerja)
");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("drop VIEW [dbo].[VW_realisasi_detail]");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180603_104047_create_view_realisasi_detail cannot be reverted.\n";

        return false;
    }
    */
}
