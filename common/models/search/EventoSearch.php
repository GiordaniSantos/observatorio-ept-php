<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Evento;
use yii\helpers\ArrayHelper;

/**
 * MembroSearch represents the model behind the search form of `common\models\Membro`.
 */
class EventoSearch extends Evento
{
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
            [[
                'id', 'titulo', 'resumo', 'destaque', 'q'
            ], 
                'safe'
            ],
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
        $query = Evento::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'evento.id' => $this->id,
            'evento.destaque' => $this->destaque,
        
        ]);

        // comparar trecho do texto
        $query->andFilterWhere(['ilike', 'evento.titulo', $this->titulo]);

        return $dataProvider;
    }
}
