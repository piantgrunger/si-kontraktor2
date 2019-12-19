<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_dt_realisasi_material".
 *
 * @property int              $id_d_realisasi
 * @property int              $id_realisasi
 * @property int              $id_sd_rab
 * @property string           $qty
 * @property string           $harga
 * @property string           $sub_total
 * @property TbMtRealisasi    $realisasi
 * @property TbSdtRabMaterial $sdRab
 */
class d_realisasi_material extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_dt_realisasi_material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sd_rab', 'qty', 'harga', 'sub_total'], 'required'],
            [['id_realisasi', 'id_sd_rab'], 'integer'],
            [['qty', 'harga', 'sub_total'], 'number'],
            [['qty'], 'cekQty'],
            [['id_realisasi'], 'exist', 'skipOnError' => true, 'targetClass' => Realisasi::className(), 'targetAttribute' => ['id_realisasi' => 'id_realisasi']],
            [['id_sd_rab'], 'exist', 'skipOnError' => true, 'targetClass' => sd_RAB_material::className(), 'targetAttribute' => ['id_sd_rab' => 'id_sd_rab']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_d_realisasi' => Yii::t('app', 'Id D Progress'),
            'id_realisasi' => Yii::t('app', 'Id Progress'),
            'id_sd_rab' => Yii::t('app', 'Id Sd Rab'),
            'qty' => Yii::t('app', 'Qty'),
            'harga' => Yii::t('app', 'Harga'),
            'sub_total' => Yii::t('app', 'Sub Total'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function cekQty($attribute, $params)
    {
        $qty = is_null($this->sdRab) ? 0 : $this->sdRab->qty;
        if (($this->qty > $qty) && ($qty > 0)) {
            Yii::$app->session->setFlash('warning', 'Qty Material '.$this->sdRab->material->nama_material.' Melebihi RAB '.$qty);
        }
    }

    public function getRealisasi()
    {
        return $this->hasOne(Realisasi::className(), ['id_realisasi' => 'id_realisasi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSdRab()
    {
        return $this->hasOne(sd_RAB_material::className(), ['id_sd_rab' => 'id_sd_rab']);
    }

    public function getQty_rab()
    {
        return is_null($this->sdRab) ? 0 : $this->sdRab->qty_sisa($this->id_realisasi);
    }

    public function getNama_material()
    {
        return is_null($this->sdRab) ? '' : $this->sdRab->nama_material;
    }

    public function loadDefaultValues($skipIfSet = true)
    {
        $this->harga = 0; //contoh set default value active true
        $this->qty = 0; //contoh set default value active true
    }

    public function init()
    {
        if ($this->isNewRecord) {
            $this->loadDefaultValues($skipIfSet = true);
        }
    }
}
