<?php

namespace common\models\search;

use common\models\Arquivo;
use yii\data\ActiveDataProvider;
use Yii;

class ArquivoSearch extends Arquivo
{
    public $ids;
    
    public function rules()
    {
        return [
            [['id','id_arquivo_categoria'], 'integer'],
            [[
                'arquivo',
                'nome_original',
                'tipo_mime',
                'tamanho',
                'legenda',
                'ativo',
                'posicao'
            ], 'safe'],
        ];
    }
    
    public function search($params)
    {
        $query = Arquivo::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        if ($this->ids) {
            $query->andFilterWhere(['in','id',$this->ids]);
        } else {
            $query->andFilterWhere([
                'id' => $this->id,
                'id_arquivo_categoria' => $this->id_arquivo_categoria,
            ]);
        }
        
        $query->andFilterWhere(['ilike', 'arquivo', $this->arquivo])
            ->andFilterWhere(['ilike', 'nome_original', $this->nome_original])
            ->andFilterWhere(['ilike', 'legenda', $this->legenda])
            ->andFilterWhere(['=', 'tamanho', $this->tamanho])
            ->andFilterWhere(['=', 'posicao', $this->posicao])
            ->andFilterWhere(['=', 'ativo', $this->ativo]);
        
        return $dataProvider;
    }
}