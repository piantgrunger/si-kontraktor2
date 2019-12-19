<?php

namespace app\models;

/**
 * This is the model class for table "tb_dt_realisasi_pekerja".
 *
 * @property int             $id_d_realisasi
 * @property int             $id_realisasi
 * @property int             $id_sd_rab
 * @property int             $id_karyawan
 * @property string          $gaji
 * @property string          $sub_total
 * @property TbMKaryawan     $karyawan
 * @property TbSdtRabPekerja $sdRab
 * @property TbMtRealisasi   $realisasi
 */
class d_realisasi_pekerja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_dt_realisasi_pekerja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sd_rab', 'id_karyawan'], 'required'],
            [['id_realisasi', 'id_sd_rab', 'id_karyawan'], 'integer'],
            [['gaji', 'sub_total'], 'number'],
            [['id_karyawan'], 'exist', 'skipOnError' => true, 'targetClass' => Karyawan::className(), 'targetAttribute' => ['id_karyawan' => 'id_karyawan']],
            [['id_sd_rab'], 'exist', 'skipOnError' => true, 'targetClass' => sd_RAB_pekerja::className(), 'targetAttribute' => ['id_sd_rab' => 'id_sd_rab']],
            [['id_realisasi'], 'exist', 'skipOnError' => true, 'targetClass' => Realisasi::className(), 'targetAttribute' => ['id_realisasi' => 'id_realisasi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_d_realisasi' => 'Id D Progress',
            'id_realisasi' => 'Id Progress',
            'id_sd_rab' => 'Id Sd Rab',
            'id_karyawan' => 'Id Karyawan',
            'gaji' => 'Gaji',
            'sub_total' => 'Sub Total',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKaryawan()
    {
        return $this->hasOne(Karyawan::className(), ['id_karyawan' => 'id_karyawan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSdRab()
    {
        return $this->hasOne(sd_RAB_pekerja::className(), ['id_sd_rab' => 'id_sd_rab']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRealisasi()
    {
        return $this->hasOne(Realisasi::className(), ['id_realisasi' => 'id_realisasi']);
    }

    public function getNama_karyawan()
    {
        return is_null($this->karyawan) ? '' : $this->karyawan->nama_karyawan;
    }

    public function getNama_level_jabatan()
    {
        return is_null($this->sdRab) ? '' : $this->sdRab->nama_level_jabatan;
    }
}
