<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "tb_m_karyawan".
 *
 * @property int $id_karyawan
 * @property int $id_level_jabatan
 * @property string $kode_karyawan
 * @property string $nama_karyawan
 * @property string $alamat_karyawan
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $status_karyawan
 * @property string $telepon
 * @property string $keterangan
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property TbMLevelJabatan $levelJabatan
 */
class Karyawan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */


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
        return 'tb_m_karyawan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_level_jabatan', 'kode_karyawan', 'nama_karyawan'], 'required'],
            [['id_level_jabatan', 'created_by', 'updated_by'], 'integer'],
            [['kode_karyawan', 'nama_karyawan', 'alamat_karyawan', 'tempat_lahir', 'status_karyawan', 'telepon', 'keterangan'], 'string'],
            [['tanggal_lahir', 'created_at', 'updated_at'], 'safe'],
            [['kode_karyawan'], 'unique'],
            [['id_level_jabatan'], 'exist', 'skipOnError' => true, 'targetClass' => LevelJabatan::className(), 'targetAttribute' => ['id_level_jabatan' => 'id_level_jabatan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_karyawan' => Yii::t('app', 'Id Karyawan'),
            'id_level_jabatan' => Yii::t('app', 'Id Level Jabatan'),
            'kode_karyawan' => Yii::t('app', 'Kode Karyawan'),
            'nama_karyawan' => Yii::t('app', 'Nama Karyawan'),
            'alamat_karyawan' => Yii::t('app', 'Alamat Karyawan'),
            'tempat_lahir' => Yii::t('app', 'Tempat Lahir'),
            'tanggal_lahir' => Yii::t('app', 'Tanggal Lahir'),
            'status_karyawan' => Yii::t('app', 'Status Karyawan'),
            'telepon' => Yii::t('app', 'Telepon'),
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
    public function getLevelJabatan()
    {
        return $this->hasOne(LevelJabatan::className(), ['id_level_jabatan' => 'id_level_jabatan']);
    }

    public function getNama_level_jabatan()
    {
        return is_null($this->levelJabatan)?"":$this->levelJabatan->nama_level_jabatan;
    }


}
