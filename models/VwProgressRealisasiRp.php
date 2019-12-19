<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_progress_realisasi".
 *
 * @property int    $id_rab
 * @property string $tgl_ak_realisasi
 * @property string $progress
 */
class VwProgressRealisasiRp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_progress_realisasi_Rp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_rab'], 'integer'],
            [['tgl_ak_realisasi'], 'required'],
            [['tgl_ak_realisasi'], 'safe'],
            [['progress'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_rab' => Yii::t('app', 'Id Rab'),
            'tgl_ak_realisasi' => Yii::t('app', 'Tgl Ak Progress'),
            'progress' => Yii::t('app', 'Progress'),
        ];
    }
}
