<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tese;
use yii\helpers\ArrayHelper;

/**
 * TeseSearch represents the model behind the search form of `common\models\Tese`.
 */
class TeseSearch extends Tese
{
    public $order;
    public $pageSize = 20;

            /**
     * @inheritdoc
     */
    public function attributes()
    {
        return ArrayHelper::merge(parent::attributes(), [
            'q'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['thesis_id', 'curriculumId'], 'integer'],
            [['title', 'institution', 'publishing_company', 'author', 'description', 'access_link', 'createdAt', 'updatedAt', 'resumo', 'data_publicacao','destaque'], 'safe'],
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
        $query = Tese::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => $this->order
            ],
            'pagination' => [
                'pageSize' => $this->pageSize,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'thesis_id' => $this->thesis_id,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'destaque' => $this->destaque,
            'resumo' => $this->resumo,
            'data_publicacao' => $this->data_publicacao,
            'curriculumId' => $this->curriculumId,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'institution', $this->institution])
            ->andFilterWhere(['like', 'publishing_company', $this->publishing_company])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'access_link', $this->access_link]);

        return $dataProvider;
    }
}
