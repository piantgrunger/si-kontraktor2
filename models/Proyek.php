<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "tb_mt_proyek".
 *
 * @property int $id_proyek
 * @property int $id_customer
 * @property string $no_proyek
 * @property string $tgl_mulai
 * @property string $tgl_selesai
 * @property string $status_proyek
 * @property string $keterangan
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property TbMCustomer $customer
 */
class Proyek extends \yii\db\ActiveRecord
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
        return 'tb_mt_proyek';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_customer', 'no_proyek', 'tgl_mulai', 'tgl_selesai', 'status_proyek'], 'required'],
            [['id_customer', 'created_by', 'updated_by'], 'integer'],
            [['no_proyek', 'status_proyek', 'keterangan'], 'string'],
            [['tgl_mulai', 'tgl_selesai', 'created_at', 'updated_at'], 'safe'],
            [['no_proyek'], 'unique'],
            [['id_customer'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['id_customer' => 'id_customer']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_proyek' => Yii::t('app', 'Id Proyek'),
            'id_customer' => Yii::t('app', 'Customer'),
            'no_proyek' => Yii::t('app', 'No Proyek'),
            'tgl_mulai' => Yii::t('app', 'Tgl Mulai'),
            'tgl_selesai' => Yii::t('app', 'Tgl Selesai'),
            'status_proyek' => Yii::t('app', 'Status Proyek'),
            'keterangan' => Yii::t('app', 'Deskripsi Proyek'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id_customer' => 'id_customer']);
    }
    public function getNama_customer()
    {
        return is_null($this->customer)?"":$this->customer->nama_customer;
    }

}
