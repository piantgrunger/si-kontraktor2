<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pekerjaan;

/**
 * PekerjaanSearch represents the model behind the search form of `app\models\Pekerjaan`.
 */
class PekerjaanSearch extends Pekerjaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pekerjaan', 'id_jenis_pekerjaan', 'created_by', 'updated_by'], 'integer'],
            [['kode_pekerjaan', 'nama_pekerjaan', 'spesifikasi', 'satuan', 'keterangan', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pekerjaan::find();

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
            'id_pekerjaan' => $this->id_pekerjaan,
            'id_jenis_pekerjaan' => $this->id_jenis_pekerjaan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'kode_pekerjaan', $this->kode_pekerjaan])
            ->andFilterWhere(['like', 'nama_pekerjaan', $this->nama_pekerjaan])
            ->andFilterWhere(['like', 'spesifikasi', $this->spesifikasi])
            ->andFilterWhere(['like', 'satuan', $this->satuan])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

            $query->orderBy('kode_pekerjaan, isnull([id_parent_pekerjaan],[id_pekerjaan]), [level] ');
        return $dataProvider;
    }
}
