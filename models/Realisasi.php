<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tb_mt_realisasi".
 *
 * @property int     $id_realisasi
 * @property int     $id_d_rab
 * @property string  $no_realisasi
 * @property string  $tgl_aw_realisasi
 * @property string  $tgl_ak_realisasi
 * @property string  $total_biaya_material
 * @property string  $total_biaya_pekerja
 * @property string  $total_biaya_peralatan
 * @property string  $keterangan
 * @property string  $created_at
 * @property string  $updated_at
 * @property int     $created_by
 * @property int     $updated_by
 * @property TbDtRab $dRab
 */
class Realisasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $duration;

    use \mdm\behaviors\ar\RelationTrait;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                 'value' => new Expression('getdate()'),
            ],
                    [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_by', 'updated_by'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by'],
                ],
            ],
        ];
    }

    public static function tableName()
    {
        return 'tb_mt_realisasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_d_rab', 'id_rab', 'no_realisasi', 'tgl_aw_realisasi', 'tgl_ak_realisasi', 'qty'], 'required'],
            [['id_d_rab', 'id_rab', 'created_by', 'updated_by'], 'integer'],
            [['no_realisasi', 'keterangan'], 'string'],
            [['tgl_aw_realisasi', 'tgl_ak_realisasi', 'created_at', 'updated_at'], 'safe'],
            [['total_biaya_material', 'total_biaya_pekerja', 'total_biaya_peralatan', 'qty'], 'number'],
            [['no_realisasi'], 'unique'],
            [['id_d_rab'], 'exist', 'skipOnError' => true, 'targetClass' => d_RAB::className(), 'targetAttribute' => ['id_d_rab' => 'id_d_rab']],
            [['id_rab'], 'exist', 'skipOnError' => true, 'targetClass' => RAB::className(), 'targetAttribute' => ['id_rab' => 'id_rab']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_realisasi' => Yii::t('app', 'Id Progress'),
            'id_d_rab' => Yii::t('app', 'Pekerjaan'),
            'id_rab' => Yii::t('app', 'RAB'),

            'no_realisasi' => Yii::t('app', 'No Progress'),
            'tgl_aw_realisasi' => Yii::t('app', 'Awal Progress'),
            'tgl_ak_realisasi' => Yii::t('app', 'Akhir Progress'),
            'total_biaya_material' => Yii::t('app', 'Total Biaya Material'),
            'total_biaya_pekerja' => Yii::t('app', 'Total Biaya Pekerja'),
            'total_biaya_peralatan' => Yii::t('app', 'Total Biaya Peralatan'),
            'keterangan' => Yii::t('app', 'Keterangan'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDRab()
    {
        return $this->hasOne(d_RAB::className(), ['id_d_rab' => 'id_d_rab']);
    }

    public function getNama_pekerjaan()
    {
        return is_null($this->dRab) ? '' : $this->dRab->nama_pekerjaan;
    }

    public function getRab()
    {
        return $this->hasOne(RAB::className(), ['id_rab' => 'id_rab']);
    }

    public function getNo_rab()
    {
        return is_null($this->rab) ? '' : $this->rab->no_rab;
    }

    public function getDet_realisasi_material()
    {
        return $this->hasMany(d_realisasi_material::className(), ['id_realisasi' => 'id_realisasi']);
    }

    public function setDet_realisasi_material($value)
    {
        return $this->loadRelated('det_realisasi_material', $value);
    }

    public function getDet_realisasi_peralatan()
    {
        return $this->hasMany(d_realisasi_peralatan::className(), ['id_realisasi' => 'id_realisasi']);
    }

    public function setDet_realisasi_peralatan($value)
    {
        return $this->loadRelated('det_realisasi_peralatan', $value);
    }

    public function getDet_realisasi_pekerja()
    {
        return $this->hasMany(d_realisasi_pekerja::className(), ['id_realisasi' => 'id_realisasi']);
    }

    public function setDet_realisasi_pekerja($value)
    {
        return $this->loadRelated('det_realisasi_pekerja', $value);
    }
}
