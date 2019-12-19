<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_realisasi_detail".
 *
 * @property string $no_rab
 * @property string $tgl_rab
 * @property int    $id_d_rab
 * @property string $kode_pekerjaan
 * @property string $nama_pekerjaan
 * @property string $qty
 * @property int    $hari_kerja
 * @property string $Total_rp
 * @property string $qty_realisasi
 * @property int    $hari_kerja_realisasi
 * @property string $total_rp_realisasi
 */
class VwRealisasiDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function primaryKey()
    {
        return ['id_d_rab'];
    }

    public static function tableName()
    {
        return 'vw_realisasi_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_rab', 'tgl_rab', 'id_d_rab', 'kode_pekerjaan', 'nama_pekerjaan', 'qty', 'hari_kerja'], 'required'],
            [['no_rab', 'kode_pekerjaan', 'nama_pekerjaan'], 'string'],
            [['tgl_rab'], 'safe'],
            [['id_d_rab', 'hari_kerja', 'hari_kerja_realisasi'], 'integer'],
            [['qty', 'Total_rp', 'qty_realisasi', 'total_rp_realisasi'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no_rab' => Yii::t('app', 'No Rab'),
            'tgl_rab' => Yii::t('app', 'Tgl Rab'),
            'id_d_rab' => Yii::t('app', 'Id D Rab'),
            'kode_pekerjaan' => Yii::t('app', 'Kode Pekerjaan'),
            'nama_pekerjaan' => Yii::t('app', 'Nama Pekerjaan'),
            'qty' => Yii::t('app', 'Qty'),
            'hari_kerja' => Yii::t('app', 'Hari Kerja'),
            'Total_rp' => Yii::t('app', 'Total Rp'),
            'qty_realisasi' => Yii::t('app', 'Qty Progress'),
            'hari_kerja_realisasi' => Yii::t('app', 'Hari Kerja Progress'),
            'total_rp_realisasi' => Yii::t('app', 'Total Rp Progress'),
        ];
    }
}
