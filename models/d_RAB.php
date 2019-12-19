<?php

namespace app\models;

use mdm\behaviors\ar\RelationTrait;
use Yii;

/**
 * This is the model class for table "tb_dt_rab".
 *
 * @property int          $id_d_RAB
 * @property int          $id_rab
 * @property int          $id_pekerjaan
 * @property string       $total_biaya_material
 * @property string       $total_biaya_pekerja
 * @property string       $total_biaya_peralatan
 * @property TbMPekerjaan $pekerjaan
 * @property TbMtRab      $rab
 */
class d_RAB extends \yii\db\ActiveRecord
{
    /*
     * {@inheritdoc}
     */
    use RelationTrait;
    public $jenis_pekerjaan;

    public static function tableName()
    {
        return 'tb_dt_rab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jenis_pekerjaan', 'level'], 'required'],
            [['id_rab', 'id_jenis_pekerjaan', 'id_pekerjaan', 'hari_kerja', 'level'], 'integer'],
            [['total_biaya_material', 'total_biaya_pekerja', 'total_biaya_peralatan', 'qty', 'total_rab', 'nilai_pagu', 'retensi_persen', 'retensi_rp'], 'number'],
            [['status_pekerjaan', 'satuan', 'status_bayar'], 'string'],
            [['id_rekanan'], 'required', 'when' => function ($model) {
                return $model->status_pekerjaan == 'Subkon';
            }, 'enableClientValidation' => false],
            [['status_bayar'], 'default', 'value' => 'Belum'],
            [['total_rab'], 'checkPagu'],
            [['id_pekerjaan'], 'exist', 'skipOnError' => true, 'targetClass' => Pekerjaan::className(), 'targetAttribute' => ['id_pekerjaan' => 'id_pekerjaan']],
            [['id_rab'], 'exist', 'skipOnError' => true, 'targetClass' => RAB::className(), 'targetAttribute' => ['id_rab' => 'id_rab']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_d_rab' => Yii::t('app', 'Id D RAB'),
            'id_rab' => Yii::t('app', 'Id RAB'),
            'id_jenis_pekerjaan' => 'Level Pekerjaan',
            'id_pekerjaan' => Yii::t('app', 'Pekerjaan'),
            'total_biaya_material' => Yii::t('app', 'Total Biaya Material'),
            'total_biaya_pekerja' => Yii::t('app', 'Total Biaya Pekerja'),
            'total_biaya_peralatan' => Yii::t('app', 'Total Biaya Peralatan'),
            'qty' => 'Volume',
            'retensi_persen' => 'Premise %',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getProgress()
    {
        $model = Realisasi::find()
            ->where(['id_d_rab' => $this->id_d_rab]);
        if (!is_null($model)) {
            return (is_null($model->sum('total_biaya_material')) ? 0 : $model->sum('total_biaya_material')) + (is_null($model->sum('total_biaya_peralatan')) ? 0 : $model->sum('total_biaya_peralatan')) + (is_null($model->sum('total_biaya_pekerja')) ? 0 : $model->sum('total_biaya_pekerja')) ;
        } else {
            return 0;
        }
    }


    public function checkPagu($attribute, $params)
    {
        $total = 0;

        if (!is_null($this->sDetailRabMaterial)) {
            foreach ($this->sDetailRabMaterial as $material) {
                $total += $material->sub_total;
            }
        }
        if (!is_null($this->sDetailRabPeralatan)) {
            foreach ($this->sDetailRabPeralatan as $material) {
                $total += $material->sub_total;
            }
        }
        if (!is_null($this->sDetailRabPekerja)) {
            foreach ($this->sDetailRabPekerja as $material) {
                $total += $material->sub_total;
            }
        }
        if ($total == 0) {
            $total = $this->total_rab;
        } else {
            $this->total_rab = $total;
        }

        if ($total > $this->nilai_pagu) {
            $this->addError($attribute, 'Total Nilai RAP tidak bisa Melebihi Pagu RAB : '.Yii::$app->formatter->asDecimal($this->nilai_pagu));
        }
        if (($total < $this->nilai_pagu) && ($total >= 0.9 * $this->nilai_pagu)) {
            Yii::$app->session->setFlash('warning', 'Total Nilai RAP '.$this->nama_jenis_pekerjaan.' Melebihi  90 %  Pagu RAB ');
        }

        return $total <= $this->nilai_pagu;
    }

    public function getPekerjaan()
    {
        return $this->hasOne(Pekerjaan::className(), ['id_pekerjaan' => 'id_pekerjaan']);
    }

    public function getNama_pekerjaan()
    {
        return is_null($this->pekerjaan) ? '' : $this->pekerjaan->nama_pekerjaan;
    }

    public function getJenisPekerjaan()
    {
        return $this->hasOne(JenisPekerjaan::className(), ['id_jenis_pekerjaan' => 'id_jenis_pekerjaan']);
    }

    public function getNama_pekerjaan_detail()
    {
        return is_null($this->jenisPekerjaan) ? '' : $this->level.' - '.$this->jenisPekerjaan->nama_jenis_pekerjaan.(is_null($this->pekerjaan) ? ''  :($this->pekerjaan->nama_pekerjaan !== $this->jenisPekerjaan->nama_jenis_pekerjaan)? ' : '.$this->pekerjaan->nama_pekerjaan : "");
    }

    public function getNama_jenis_pekerjaan()
    {
        return is_null($this->jenisPekerjaan) ? '' : $this->level.'-'.$this->jenisPekerjaan->nama_jenis_pekerjaan;
    }

    public function getSatuan()
    {
        return is_null($this->pekerjaan) ? '' : $this->pekerjaan->satuan;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRab()
    {
        return $this->hasOne(RAB::className(), ['id_rab' => 'id_rab']);
    }

    public function getNo_rab()
    {
        return is_null($this->rab) ? '' : $this->rab->no_rab;
    }

    public function getHarga()
    {
        return  Yii::$app->formatter->asDecimal(($this->qty == 0) ? 0 : round($this->total_rab / $this->qty, 2));
    }

    public function getTotal_rab_display()
    {
        return Yii::$app->formatter->asDecimal($this->total_rab);
    }

    public function getSDetailRabMaterial()
    {
        return $this->hasMany(sd_RAB_material::className(), ['id_d_rab' => 'id_d_rab']);
    }

    public function setSDetailRabMaterial($value)
    {
        return $this->loadRelated('sDetailRabMaterial', $value);
    }

    public function getSDetailRabPeralatan()
    {
        return $this->hasMany(sd_RAB_peralatan::className(), ['id_d_rab' => 'id_d_rab']);
    }

    public function setSDetailRabPeralatan($value)
    {
        return $this->loadRelated('sDetailRabPeralatan', $value);
    }

    public function getSDetailRabPekerja()
    {
        return $this->hasMany(sd_RAB_pekerja::className(), ['id_d_rab' => 'id_d_rab']);
    }

    public function setSDetailRabPekerja($value)
    {
        return $this->loadRelated('sDetailRabPekerja', $value);
    }
}
