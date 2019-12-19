<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "tb_m_jenis_bangunan".
 *
 * @property int $id_jenis_bangunan
 * @property string $kode_jenis_bangunan
 * @property string $nama_jenis_bangunan
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Jenisbangunan extends \yii\db\ActiveRecord
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
        return 'tb_m_jenis_bangunan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode_jenis_bangunan', 'nama_jenis_bangunan'], 'required'],
            [['kode_jenis_bangunan', 'nama_jenis_bangunan'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['nama_jenis_bangunan'], 'unique'],
            [['kode_jenis_bangunan'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_jenis_bangunan' => Yii::t('app', 'Id Jenis Bangunan'),
            'kode_jenis_bangunan' => Yii::t('app', 'Kode Jenis Bangunan'),
            'nama_jenis_bangunan' => Yii::t('app', 'Nama Jenis Bangunan'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
