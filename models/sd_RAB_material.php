<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_sdt_rab_material".
 *
 * @property int         $id_sd_rab
 * @property int         $id_d_RAB
 * @property int         $id_material
 * @property string      $qty
 * @property string      $sub_total
 * @property TbDtRab     $dRab
 * @property TbMMaterial $material
 */
class sd_RAB_material extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $material_detail;
    public $kelompok_material;

    public static function tableName()
    {
        return 'tb_sdt_rab_material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_material', 'qty', 'sub_total', 'harga', 'satuan'], 'required'],
            [['id_d_rab', 'id_material'], 'integer'],
            [['qty', 'sub_total', 'harga'], 'number'],
            [['id_d_rab'], 'exist', 'skipOnError' => true, 'targetClass' => d_RAB::className(), 'targetAttribute' => ['id_d_rab' => 'id_d_rab']],
            [['id_material'], 'exist', 'skipOnError' => true, 'targetClass' => Material::className(), 'targetAttribute' => ['id_material' => 'id_material']],
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
            'id_material' => Yii::t('app', 'Id Material'),
            'qty' => Yii::t('app', 'qty'),
            'sub_total' => Yii::t('app', 'Sub Total'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDRab()
    {
        return $this->hasOne(d_RAB::className(), ['id_d_rab' => 'id_d_rab']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::className(), ['id_material' => 'id_material']);
    }

    public function getNama_material()
    {
        return is_null($this->material) ? '' : $this->material->nama_material;
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

    public function qty_sisa($id)
    {
        $qty_realisasi = d_realisasi_material::find()
                                 ->where(['id_sd_rab' => $this->id_sd_rab])
                                  ->andWhere(['<>', 'id_realisasi', $id])
                                  ->sum('qty')
                                  ;
        //die(var_dump(is_null($qty_realisasi)));
        return $this->qty - (is_null($qty_realisasi) ? 0 : $qty_realisasi);
    }

    public function getQty_realisasi()
    {
        $qty_realisasi = d_realisasi_material::find()
            ->where(['id_sd_rab' => $this->id_sd_rab])
            ->sum('qty');
        //die(var_dump(is_null($qty_realisasi)));
        return  is_null($qty_realisasi) ? 0 : $qty_realisasi;
    }

    public function getSub_tot_realisasi()
    {
        $qty_realisasi = d_realisasi_material::find()
            ->where(['id_sd_rab' => $this->id_sd_rab])
            ->sum('sub_total');
        //die(var_dump(is_null($qty_realisasi)));
        return is_null($qty_realisasi) ? 0 : $qty_realisasi;
    }
}
