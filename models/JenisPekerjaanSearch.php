<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JenisPekerjaan;

/**
 * JenisPekerjaanSearch represents the model behind the search form of `app\models\JenisPekerjaan`.
 */
class JenisPekerjaanSearch extends JenisPekerjaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_jenis_pekerjaan', 'created_by', 'updated_by'], 'integer'],
            [['kode_jenis_pekerjaan', 'nama_jenis_pekerjaan', 'keterangan', 'created_at', 'updated_at'], 'safe'],
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
        $query = JenisPekerjaan::find();

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
            'id_jenis_pekerjaan' => $this->id_jenis_pekerjaan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'kode_jenis_pekerjaan', $this->kode_jenis_pekerjaan])
            ->andFilterWhere(['like', 'nama_jenis_pekerjaan', $this->nama_jenis_pekerjaan])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
