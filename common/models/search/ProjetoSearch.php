<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Projeto;

/**
 * ProjetoSearch represents the model behind the search form of `common\models\Projeto`.
 */
class ProjetoSearch extends Projeto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'curriculumId'], 'integer'],
            [['title', 'description', 'members', 'financiers', 'createdAt', 'updatedAt'], 'safe'],
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Projeto::find();

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
            'project_id' => $this->project_id,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'curriculumId' => $this->curriculumId,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'members', $this->members])
            ->andFilterWhere(['like', 'financiers', $this->financiers]);

        return $dataProvider;
    }
}
