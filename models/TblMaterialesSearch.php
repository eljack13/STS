<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblMateriales;

/**
 * TblMaterialesSearch represents the model behind the search form of `app\models\TblMateriales`.
 */
class TblMaterialesSearch extends TblMateriales
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tbl_materiales_id', 'tbl_materiales_cantidad', 'tbl_materiales_fechaingreso'], 'integer'],
            [['tbl_materiales_nombre', 'tbl_materiales_descripcion', 'tbl_materiales_created', 'tbl_materiales_createdby'], 'safe'],
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = TblMateriales::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'tbl_materiales_id' => $this->tbl_materiales_id,
            'tbl_materiales_cantidad' => $this->tbl_materiales_cantidad,
            'tbl_materiales_fechaingreso' => $this->tbl_materiales_fechaingreso,
            'tbl_materiales_created' => $this->tbl_materiales_created,
            'tbl_materiales_createdby' => $this->tbl_materiales_createdby,
        ]);

        $query->andFilterWhere(['like', 'tbl_materiales_nombre', $this->tbl_materiales_nombre])
            ->andFilterWhere(['like', 'tbl_materiales_descripcion', $this->tbl_materiales_descripcion]);

        return $dataProvider;
    }
}
