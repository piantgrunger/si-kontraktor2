<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "tb_m_rekanan".
 *
 * @property int $id_rekanan
 * @property string $kode_rekanan
 * @property string $nama_rekanan
 * @property string $alamat_rekanan
 * @property string $kota
 * @property string $telepon
 * @property string $fax
 * @property string $kontak_person
 * @property string $keterangan
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Rekanan extends \yii\db\ActiveRecord
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
        return 'tb_m_rekanan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_rekanan', 'nama_rekanan', 'kota'], 'required'],
            [['kode_rekanan', 'nama_rekanan', 'alamat_rekanan', 'kota', 'telepon', 'fax', 'kontak_person', 'keterangan'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['kode_rekanan'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_rekanan' => Yii::t('app', 'Id Rekanan'),
            'kode_rekanan' => Yii::t('app', 'Kode Rekanan'),
            'nama_rekanan' => Yii::t('app', 'Nama Rekanan'),
            'alamat_rekanan' => Yii::t('app', 'Alamat Rekanan'),
            'kota' => Yii::t('app', 'Kota'),
            'telepon' => Yii::t('app', 'Telepon'),
            'fax' => Yii::t('app', 'Fax'),
            'kontak_person' => Yii::t('app', 'Kontak Person'),
            'keterangan' => Yii::t('app', 'Keterangan'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
