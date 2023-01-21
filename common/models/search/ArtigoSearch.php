<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Artigo;
use yii\helpers\ArrayHelper;

/**
 * ArtigoSearch represents the model behind the search form of `common\models\Artigo`.
 */
class ArtigoSearch extends Artigo
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
            [['article_id', 'data_publicacao', 'curriculumId'], 'integer'],
            [['authors', 'title', 'dissemination_vehicle', 'access_link', 'createdAt', 'updatedAt' , 'destaque', 'q'], 'safe'],
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
        $query = Artigo::find();

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
            // uncomment the following line if  ou do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'article_id' => $this->article_id,
            'data_publicacao' => $this->data_publicacao,
            'createdAt' => $this->createdAt,
            'destaque' => $this->destaque,
            'updatedAt' => $this->updatedAt,
            'curriculumId' => $this->curriculumId,
        ]);

        $query->andFilterWhere(['like', 'authors', $this->authors])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'dissemination_vehicle', $this->dissemination_vehicle])
            ->andFilterWhere(['like', 'access_link', $this->access_link]);

        return $dataProvider;
    }
}
