<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProgressSearch represents the model behind the search form of `app\models\Realisasi`.
 */
class RealisasiSearch extends Realisasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_realisasi', 'id_d_rab', 'created_by', 'updated_by'], 'integer'],
            [['no_realisasi', 'tgl_aw_realisasi', 'tgl_ak_realisasi', 'keterangan', 'created_at', 'updated_at'], 'safe'],
            [['total_biaya_material', 'total_biaya_pekerja', 'total_biaya_peralatan'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Realisasi::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_realisasi' => $this->id_realisasi,
            'id_d_rab' => $this->id_d_rab,
            'tgl_aw_realisasi' => $this->tgl_aw_realisasi,
            'tgl_ak_realisasi' => $this->tgl_ak_realisasi,
            'total_biaya_material' => $this->total_biaya_material,
            'total_biaya_pekerja' => $this->total_biaya_pekerja,
            'total_biaya_peralatan' => $this->total_biaya_peralatan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'no_realisasi', $this->no_realisasi])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
