<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use mdm\behaviors\ar\RelationTrait;

/**
 * This is the model class for table "tb_mt_rab".
 *
 * @property int        $id_rab
 * @property int        $id_proyek
 * @property string     $no_rab
 * @property string     $tgl_rab
 * @property string     $total_biaya_material
 * @property string     $total_biaya_pekerja
 * @property string     $total_biaya_peralatan
 * @property string     $margin
 * @property string     $dana_cadangan
 * @property string     $total_rab
 * @property string     $keterangan
 * @property string     $created_at
 * @property string     $updated_at
 * @property int        $created_by
 * @property int        $updated_by
 * @property TbMtProyek $proyek
 */
class RAB_history extends \yii\db\ActiveRecord
{
    /*
     * @inheritdoc
     */
    use RelationTrait;

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
        return 'tb_mt_rab_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_proyek', 'no_rab', 'tgl_rab'], 'required'],
            [['id_proyek', 'created_by', 'updated_by'], 'integer'],
            [['no_rab', 'keterangan'], 'string'],
            [['tgl_rab', 'created_at', 'updated_at'], 'safe'],
            [['total_biaya_material', 'total_biaya_pekerja', 'total_biaya_peralatan', 'margin', 'dana_cadangan', 'total_rab', 'ppn', 'ppn_rp'], 'number'],
            [['no_rab'], 'unique'],
            [['id_proyek'], 'exist', 'skipOnError' => true, 'targetClass' => Proyek::className(), 'targetAttribute' => ['id_proyek' => 'id_proyek']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_rab' => Yii::t('app', 'Id RAB'),
            'id_proyek' => Yii::t('app', 'Proyek'),
            'no_rab' => Yii::t('app', 'Nomor'),
            'tgl_rab' => Yii::t('app', 'Tanggal'),
            'total_biaya_material' => Yii::t('app', 'Total Biaya Material'),
            'total_biaya_pekerja' => Yii::t('app', 'Total Biaya Pekerja'),
            'total_biaya_peralatan' => Yii::t('app', 'Total Biaya Peralatan'),
             'margin' => Yii::t('app', 'Margin'),
            'dana_cadangan' => Yii::t('app', 'Dana Cadangan'),
            'keterangan' => Yii::t('app', 'Keterangan'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'ppn' => 'PPN (%)',
            'nilai_real' => 'Nilai RAP',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyek()
    {
        return $this->hasOne(Proyek::className(), ['id_proyek' => 'id_proyek']);
    }

    public function getNo_Proyek()
    {
        return is_null($this->proyek) ? '' : $this->proyek->no_proyek;
    }

    public function getDetailRab()
    {
        return $this->hasMany(d_RAB_history::className(), ['id_rab' => 'id_rab']);
    }

    public function setDetailRab($value)
    {
        return $this->loadRelated('detailRab', $value);
    }
}
