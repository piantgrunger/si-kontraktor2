<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\web\UploadedFile;
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
class RAB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $old_file_acuan_revisi;
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
        return 'tb_mt_rab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_proyek', 'no_rab', 'tgl_rab', 'ppn', 'nilai_kontrak',  'id_jenis_bangunan'], 'required'],
            [['id_proyek', 'created_by', 'updated_by'], 'integer'],
            [['no_rab', 'keterangan'], 'string'],
            [['tgl_rab', 'created_at', 'updated_at', 'tgl_revisi'], 'safe'],
            [['total_biaya_material', 'total_biaya_pekerja', 'total_biaya_peralatan', 'margin', 'dana_cadangan', 'total_rab', 'ppn', 'ppn_rp', 'nilai_kontrak', 'nilai_real', 'retensi_rp'], 'number'],
            [['file_acuan_revisi'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,bmp,pdf,jpeg,doc,docx', 'maxSize' => 512000000],

            [['no_rab'], 'unique'],
            [['tgl_revisi'], 'required', 'on' => 'revisi'],
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
            'tgl_rab' => Yii::t('app', 'Update'),
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
            'ppn_rp' => 'PPN',

            'nilai_real' => 'Total RAB',
           // 'nilai_kontrak' => 'Total RAB',
            'total_rab' => 'Total RAP',
            'total_dpp' =>'Sub Total RAP',
            'retensi' => 'Riil Cost (Progress)'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRetensi()
    {
        $model = Realisasi::find()
        ->where(['id_rab' => $this->id_rab]);
        if (!is_null($model)) {
            return (is_null($model->sum('total_biaya_material'))?0: $model->sum('total_biaya_material'))+
                (is_null($model->sum('total_biaya_peralatan')) ? 0 : $model->sum('total_biaya_peralatan'))+
                (is_null($model->sum('total_biaya_pekerja')) ? 0 : $model->sum('total_biaya_pekerja'));
        } else {
            return 0;
        }
    }
    public function getPeriode_awal(){

        $d = date_parse_from_format("Y-m-d", $this->tgl_rab);
        if ($d["day"]<25) {
            return date_create_from_format("Y-m-d", $d["year"].'-' .($d["month"]-1) ."-26");

        } else
        {
            return date_create_from_format("Y-m-d", $d["year"] . '-' . $d["month"]  . "-26");

        }

    }

    public function getPeriode_akhir()
    {

        $d = date_parse_from_format("Y-m-d", $this->tgl_rab);
        if ($d["day"] < 25) {
            return date_create_from_format("Y-m-d", $d["year"] . '-' . $d["month"]  . "-25");

        } else {
            return date_create_from_format("Y-m-d", $d["year"] . '-' . ($d["month"]+1) . "-25");

        }

    }

    public function getProyek()
    {
        return $this->hasOne(Proyek::className(), ['id_proyek' => 'id_proyek']);
    }

    public function getRekap_pekerjaan()
    {
        $model = d_RAB::find()->select(['jenis_pekerjaan' => 'nama_jenis_pekerjaan', 'total_rab' => 'sum(total_rab)'])
                      ->innerJoin('tb_m_jenis_pekerjaan', 'tb_dt_RAB.id_jenis_pekerjaan=tb_m_jenis_pekerjaan.id_jenis_pekerjaan ')
                       ->where(['id_rab' => $this->id_rab])
                      ->groupBy('nama_jenis_pekerjaan')
                      ->all();

        return $model;
    }

    public function getDaftar_harga()
    {
        $expression = new Expression("'Upah Buruh'");
        $model1 = sd_RAB_material::find()->select(['kelompok_material' => 'kelompok_material',  'material_detail' => 'nama_material', 'harga' => 'tb_sdt_rab_material.harga'])
            ->distinct()
        ->innerJoin('tb_m_material', 'tb_m_material.id_material=tb_sdt_rab_material.id_material ')
            ->innerJoin('tb_dt_rab', 'tb_dt_rab.id_d_rab=tb_sdt_rab_material.id_d_rab ')
            ->where(['id_rab' => $this->id_rab])

            ;
        $model2 = sd_RAB_pekerja::find()->select(['kelompok_material' => $expression, 'nama_level_jabatan' => 'nama_level_jabatan', 'harga' => 'gaji'])
            ->distinct()
            ->innerJoin('tb_m_level_jabatan', 'tb_m_level_jabatan.id_level_jabatan=tb_sdt_rab_pekerja.id_level_jabatan ')
            ->innerJoin('tb_dt_rab', 'tb_dt_rab.id_d_rab=tb_sdt_rab_pekerja.id_d_rab ')
            ->where(['id_rab' => $this->id_rab])

            ;
        $model3 = sd_RAB_peralatan::find()->select(['kelompok_material' => 'kelompok_material', 'nama_material' => 'nama_material', 'harga' => 'tb_sdt_rab_peralatan.harga'])
            ->distinct()
            ->innerJoin('tb_m_material', 'tb_m_material.id_material=tb_sdt_rab_peralatan.id_material ')
            ->innerJoin('tb_dt_rab', 'tb_dt_rab.id_d_rab=tb_sdt_rab_peralatan.id_d_rab ')
            ->where(['id_rab' => $this->id_rab])

            ;

        $result = $model1->union($model2, true)->union($model3, true);

        return $result->all();
    }

    public function getNo_Proyek()
    {
        return is_null($this->proyek) ? '' : $this->proyek->no_proyek;
    }

    public function getJenisbangunan()
    {
        return $this->hasOne(Jenisbangunan::className(), ['id_jenis_bangunan' => 'id_jenis_bangunan']);
    }

    public function getNama_jenis_bangunan()
    {
        return is_null($this->jenisbangunan) ? '' : $this->jenisbangunan->nama_jenis_bangunan;
    }

    public function getTotal_dpp()
    {
        return $this->total_rab - $this->ppn_rp;
    }

    public function getDetailRab()
    {
        return $this->hasMany(d_RAB::className(), ['id_rab' => 'id_rab'])
        ->leftJoin('tb_m_jenis_pekerjaan', 'tb_m_jenis_pekerjaan.id_jenis_pekerjaan = tb_dt_rab.id_jenis_pekerjaan')
        ->orderBy(' level ');
    }

    public function setDetailRab($value)
    {
        return $this->loadRelated('detailRab', $value);
    }

    public function upload($fieldName)
    {
        $path = Yii::getAlias('@app').'/web/media/';

        $image = UploadedFile::getInstance($this, $fieldName);

        if (!empty($image) && $image->size !== 0) {
            $fileNames = md5($this->no_rab).'.'.$image->extension;

            if ($image->saveAs($path.$fileNames)) {
                $this->attributes = array($fieldName => $fileNames);

                return true;
            } else {
                return false;
            }
        } else {
            if ($fieldName === 'file_acuan_revisi') {
                $this->attributes = array($fieldName => $this->old_file_acuan_revisi);
            }

            return true;
        }
    }
}
