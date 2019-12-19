<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tb_m_pekerjaan".
 *
 * @property int               $id_pekerjaan
 * @property int               $id_jenis_pekerjaan
 * @property string            $kode_pekerjaan
 * @property string            $nama_pekerjaan
 * @property string            $spesifikasi
 * @property string            $satuan
 * @property string            $keterangan
 * @property string            $created_at
 * @property string            $updated_at
 * @property int               $created_by
 * @property int               $updated_by
 * @property TbMJenisPekerjaan $jenisPekerjaan
 */
class Pekerjaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
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

                [
                    'class' => AttributeBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['level'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['level'],
                    ],
                    'value' => function ($event) {
                        return is_null($this->parentPekerjaan) ? 1 : $this->parentPekerjaan->level + 1;
                    },
                ],
        ];
    }

    public static function tableName()
    {
        return 'tb_m_pekerjaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_pekerjaan', 'nama_pekerjaan', 'satuan'], 'required'],
            [['id_jenis_pekerjaan', 'created_by', 'updated_by'], 'integer'],
            [['kode_pekerjaan', 'nama_pekerjaan',  'satuan', 'keterangan'], 'string'],
            [['created_at', 'updated_at', 'level', 'id_parent_pekerjaan'], 'safe'],
            [['kode_pekerjaan'], 'unique'],
            [['id_jenis_pekerjaan'], 'exist', 'skipOnError' => true, 'targetClass' => JenisPekerjaan::className(), 'targetAttribute' => ['id_jenis_pekerjaan' => 'id_jenis_pekerjaan']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pekerjaan' => Yii::t('app', 'Id Pekerjaan'),
            'id_jenis_pekerjaan' => Yii::t('app', 'Jenis Pekerjaan'),
            'kode_pekerjaan' => Yii::t('app', 'Kode Pekerjaan'),
            'nama_pekerjaan' => Yii::t('app', 'Nama Pekerjaan'),
            'nama_pekerjaan_view' => Yii::t('app', 'Nama Pekerjaan'),

            'satuan' => Yii::t('app', 'Satuan'),
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
    public function getJenisPekerjaan()
    {
        return $this->hasOne(JenisPekerjaan::className(), ['id_jenis_pekerjaan' => 'id_jenis_pekerjaan']);
    }

    public function getNama_jenis_pekerjaan()
    {
        return is_null($this->jenisPekerjaan) ? '' : $this->jenisPekerjaan->nama_jenis_pekerjaan;
    }

    public function getParentPekerjaan()
    {
        return $this->hasOne(Pekerjaan::className(), ['id_pekerjaan' => 'id_parent_pekerjaan']);
    }

    public function getParent_pekerjaan()
    {
        return is_null($this->parentPekerjaan) ? '' : $this->parentPekerjaan->kode_pekerjaan.'-'.$this->parentPekerjaan->nama_pekerjaan;
    }

    public function getNama_parent_pekerjaan()
    {
        return is_null($this->parentPekerjaan) ? '' : $this->parentPekerjaan->nama_pekerjaan;
    }

    public function getNama_pekerjaan_view()
    {
        return is_null($this->parentPekerjaan) ? $this->nama_pekerjaan : str_repeat(' .. ', $this->level).' '.$this->nama_pekerjaan;
    }
}
