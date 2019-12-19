<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LevelJabatan;

/**
 * LevelJabatanSearch represents the model behind the search form of `app\models\LevelJabatan`.
 */
class LevelJabatanSearch extends LevelJabatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_level_jabatan', 'created_by', 'updated_by'], 'integer'],
            [['kode_level_jabatan', 'nama_level_jabatan', 'keterangan', 'created_at', 'updated_at'], 'safe'],
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
        $query = LevelJabatan::find();

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
            'id_level_jabatan' => $this->id_level_jabatan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'kode_level_jabatan', $this->kode_level_jabatan])
            ->andFilterWhere(['like', 'nama_level_jabatan', $this->nama_level_jabatan])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
