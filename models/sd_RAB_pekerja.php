<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_sdt_rab_pekerja".
 *
 * @property int             $id_sd_rab
 * @property int             $id_d_RAB
 * @property int             $id_level_jabatan
 * @property string          $gaji
 * @property string          $qty
 * @property string          $sub_total
 * @property TbDtRab         $dRab
 * @property TbMLevelJabatan $levelJabatan
 */
class sd_RAB_pekerja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_sdt_rab_pekerja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_level_jabatan', 'satuan'], 'required'],
            [['id_d_rab', 'id_level_jabatan'], 'integer'],
            [['gaji', 'qty', 'sub_total'], 'number'],
            [['id_d_rab'], 'exist', 'skipOnError' => true, 'targetClass' => d_RAB::className(), 'targetAttribute' => ['id_d_rab' => 'id_d_rab']],
            [['id_level_jabatan'], 'exist', 'skipOnError' => true, 'targetClass' => LevelJabatan::className(), 'targetAttribute' => ['id_level_jabatan' => 'id_level_jabatan']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sd_rab' => Yii::t('app', 'Id Sd RAB'),
            'id_d_rab' => Yii::t('app', 'Id D RAB'),
            'id_level_jabatan' => Yii::t('app', 'Id Level Jabatan'),
            'gaji' => Yii::t('app', 'Gaji'),
            'qty' => Yii::t('app', 'Qty'),
            'sub_total' => Yii::t('app', 'Sub Total'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDRab()
    {
        return $this->hasOne(TbDtRab::className(), ['id_d_rab' => 'id_d_rab']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevelJabatan()
    {
        return $this->hasOne(LevelJabatan::className(), ['id_level_jabatan' => 'id_level_jabatan']);
    }

    public function getNama_level_jabatan()
    {
        return is_null($this->levelJabatan) ? '' : $this->levelJabatan->nama_level_jabatan;
    }

    public function loadDefaultValues($skipIfSet = true)
    {
        $this->gaji = 0; //contoh set default value active true
        $this->qty = 0; //contoh set default value active true
        $this->satuan = 'OH';
    }

    public function init()
    {
        if ($this->isNewRecord) {
            $this->loadDefaultValues($skipIfSet = true);
        }
    }

    public function getQty_realisasi()
    {
        $qty_realisasi = d_realisasi_pekerja::find()
            ->where(['id_sd_rab' => $this->id_sd_rab])
            ->sum('gaji');
        //die(var_dump(is_null($qty_realisasi)));
        return is_null($qty_realisasi) ? 0 : $qty_realisasi;
    }

    public function getSub_tot_realisasi()
    {
        $qty_realisasi = d_realisasi_pekerja::find()
            ->where(['id_sd_rab' => $this->id_sd_rab])
            ->sum('sub_total');
        //die(var_dump(is_null($qty_realisasi)));
        return is_null($qty_realisasi) ? 0 : $qty_realisasi;
    }
}
