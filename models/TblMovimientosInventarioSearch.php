<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblMovimientosInventario;

class TblMovimientosInventarioSearch extends TblMovimientosInventario
{
    public function rules()
    {
        return [
            [['id', 'material_id', 'usuario_id'], 'integer'],
            [['tipo', 'fecha', 'motivo'], 'safe'],
            [['entrada_salida_ajuste', 'cantidad'], 'number'],
        ];
    }

    public function search($params)
    {
        $query = TblMovimientosInventario::find()->with(['material', 'usuario']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['fecha' => SORT_DESC],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'material_id' => $this->material_id,
            'entrada_salida_ajuste' => $this->entrada_salida_ajuste,
            'cantidad' => $this->cantidad,
            'fecha' => $this->fecha,
            'usuario_id' => $this->usuario_id,
        ]);

        $query->andFilterWhere(['like', 'tipo', $this->tipo])
              ->andFilterWhere(['like', 'motivo', $this->motivo]);

        return $dataProvider;
    }
}