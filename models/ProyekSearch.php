<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Proyek;

/**
 * ProyekSearch represents the model behind the search form of `app\models\Proyek`.
 */
class ProyekSearch extends Proyek
{
    /**
     * @inheritdoc
     */
    public $tgl_aw;
     public $tgl_ak;


    public function rules()
    {
        return [
            [['id_proyek', 'id_customer', 'created_by', 'updated_by'], 'integer'],
            [['no_proyek', 'tgl_mulai', 'tgl_selesai', 'status_proyek', 'keterangan', 'created_at', 'updated_at','tgl_aw','tgl_ak'], 'safe'],
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
        $query = Proyek::find();

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
            'id_proyek' => $this->id_proyek,
            'id_customer' => $this->id_customer,
            'tgl_mulai' => $this->tgl_mulai,
            'tgl_selesai' => $this->tgl_selesai,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'no_proyek', $this->no_proyek])
            ->andFilterWhere(['like', 'status_proyek', $this->status_proyek])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);
         if((!$this->tgl_aw==null)  && (!$this->tgl_ak == null) )
         {
                $query->andFilterWhere(['between', 'tgl_mulai', $this->tgl_aw, $this->tgl_ak]);
                $query->andFilterWhere(['between', 'tgl_selesai', $this->tgl_aw, $this->tgl_ak]);
         }

        return $dataProvider;
    }
}
