<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "tb_m_customer".
 *
 * @property int $id_customer
 * @property string $kode_customer
 * @property string $nama_customer
 * @property string $alamat_customer
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
class Customer extends \yii\db\ActiveRecord
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
        return 'tb_m_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_customer', 'nama_customer', 'kota'], 'required'],
            [['kode_customer', 'nama_customer', 'alamat_customer', 'kota', 'telepon', 'fax', 'kontak_person', 'keterangan'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['kode_customer'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_customer' => Yii::t('app', 'Id Customer'),
            'kode_customer' => Yii::t('app', 'Kode Customer'),
            'nama_customer' => Yii::t('app', 'Nama Customer'),
            'alamat_customer' => Yii::t('app', 'Alamat Customer'),
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
