<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblUsuarios;

/**
 * TblUsuariosSearch represents the model behind the search form of `app\models\TblUsuarios`.
 */
class TblUsuariosSearch extends TblUsuarios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tbl_usuarios_id'], 'integer'],
            [['tbl_usuarios_nombre', 'tbl_usuarios_apellido', 'tbl_usuarios_email', 'tbl_usuarios_password', 'tbl_usuarios_recoverpass', 'tbl_usuarios_auth_key', 'tbl_usuarios_access_token', 'tbl_usuarios_telefono', 'tbl_usuarios_rol', 'tbl_usuarios_created', 'tbl_usuarios_createdby'], 'safe'],
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
        $query = TblUsuarios::find();

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
            'tbl_usuarios_id' => $this->tbl_usuarios_id,
            'tbl_usuarios_created' => $this->tbl_usuarios_created,
            'tbl_usuarios_createdby' => $this->tbl_usuarios_createdby,
        ]);

        $query->andFilterWhere(['like', 'tbl_usuarios_nombre', $this->tbl_usuarios_nombre])
            ->andFilterWhere(['like', 'tbl_usuarios_apellido', $this->tbl_usuarios_apellido])
            ->andFilterWhere(['like', 'tbl_usuarios_email', $this->tbl_usuarios_email])
            ->andFilterWhere(['like', 'tbl_usuarios_password', $this->tbl_usuarios_password])
            ->andFilterWhere(['like', 'tbl_usuarios_recoverpass', $this->tbl_usuarios_recoverpass])
            ->andFilterWhere(['like', 'tbl_usuarios_auth_key', $this->tbl_usuarios_auth_key])
            ->andFilterWhere(['like', 'tbl_usuarios_access_token', $this->tbl_usuarios_access_token])
            ->andFilterWhere(['like', 'tbl_usuarios_telefono', $this->tbl_usuarios_telefono])
            ->andFilterWhere(['like', 'tbl_usuarios_rol', $this->tbl_usuarios_rol]);

        return $dataProvider;
    }
}
