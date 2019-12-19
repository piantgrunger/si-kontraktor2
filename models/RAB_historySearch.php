<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RAB;

/**
 * RABSearch represents the model behind the search form of `app\models\RAB`.
 */
class RAB_historySearch extends RAB_history
{
    /**
     * @inheritdoc
     */
    public $tgl_aw;
    public $tgl_ak;

    public function rules()
    {
        return [
            [['id_rab', 'id_proyek', 'created_by', 'updated_by'], 'integer'],
            [['no_rab', 'tgl_rab', 'keterangan', 'created_at', 'updated_at','tgl_aw','tgl_ak'], 'safe'],
            [['total_biaya_material', 'total_biaya_pekerja', 'total_biaya_peralatan', 'margin', 'dana_cadangan', 'total_rab'], 'number'],
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
        $query = RAB_history::find();

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
            'id_rab' => $this->id_rab,
            'id_proyek' => $this->id_proyek,
            'tgl_rab' => $this->tgl_rab,
            'total_biaya_material' => $this->total_biaya_material,
            'total_biaya_pekerja' => $this->total_biaya_pekerja,
            'total_biaya_peralatan' => $this->total_biaya_peralatan,
            'margin' => $this->margin,
            'dana_cadangan' => $this->dana_cadangan,
            'total_rab' => $this->total_rab,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'no_rab', $this->no_rab])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['between', 'tgl_rab', $this->tgl_aw, $this->tgl_ak]);


        return $dataProvider;
    }
}
