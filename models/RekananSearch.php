<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rekanan;

/**
 * RekananSearch represents the model behind the search form of `app\models\Rekanan`.
 */
class RekananSearch extends Rekanan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_rekanan', 'created_by', 'updated_by'], 'integer'],
            [['kode_rekanan', 'nama_rekanan', 'alamat_rekanan', 'kota', 'telepon', 'fax', 'kontak_person', 'keterangan', 'created_at', 'updated_at'], 'safe'],
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
        $query = Rekanan::find();

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
            'id_rekanan' => $this->id_rekanan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'kode_rekanan', $this->kode_rekanan])
            ->andFilterWhere(['like', 'nama_rekanan', $this->nama_rekanan])
            ->andFilterWhere(['like', 'alamat_rekanan', $this->alamat_rekanan])
            ->andFilterWhere(['like', 'kota', $this->kota])
            ->andFilterWhere(['like', 'telepon', $this->telepon])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'kontak_person', $this->kontak_person])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
