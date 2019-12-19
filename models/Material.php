<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tb_m_material".
 *
 * @property int    $id_material
 * @property string $kode_material
 * @property string $nama_material
 * @property string $spesifikasi
 * @property string $satuan
 * @property string $keterangan
 * @property string $created_at
 * @property string $updated_at
 * @property int    $created_by
 * @property int    $updated_by
 */
class Material extends \yii\db\ActiveRecord
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
        ];
    }

    public static function tableName()
    {
        return 'tb_m_material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_material', 'nama_material', 'satuan', 'jenis',  'kelompok_material'], 'required'],
            [['kode_material', 'nama_material', 'spesifikasi', 'satuan', 'keterangan'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['harga'], 'number'],
            [['created_by', 'updated_by'], 'integer'],
            [['kode_material'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_material' => Yii::t('app', 'Id Material'),
            'kode_material' => Yii::t('app', 'Kode Material / Peralatan '),
            'nama_material' => Yii::t('app', 'Nama Material / Peralatan '),
            'spesifikasi' => Yii::t('app', 'Spesifikasi'),
            'satuan' => Yii::t('app', 'Satuan'),
            'keterangan' => Yii::t('app', 'Keterangan'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
