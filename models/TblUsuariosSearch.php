<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblUsuarios;

/**
 * TblUsuariosSearch representa el modelo detrás del formulario de búsqueda de TblUsuarios.
 */
class TblUsuariosSearch extends Model
{
    public $tbl_usuarios_id;
    public $tbl_usuarios_nombre;
    public $tbl_usuarios_apellido;
    public $tbl_usuarios_email;
    public $tbl_usuarios_telefono;
    public $tbl_usuarios_rol;
    public $tbl_usuarios_created;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tbl_usuarios_id'], 'integer'],
            [['tbl_usuarios_nombre', 'tbl_usuarios_apellido', 'tbl_usuarios_email', 'tbl_usuarios_telefono', 'tbl_usuarios_rol', 'tbl_usuarios_created'], 'safe'],
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
        $query = TblUsuarios::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'tbl_usuarios_id' => SORT_DESC,
                ]
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
            'tbl_usuarios_id' => $this->tbl_usuarios_id,
            'tbl_usuarios_created' => $this->tbl_usuarios_created,
        ]);

        $query->andFilterWhere(['like', 'tbl_usuarios_nombre', $this->tbl_usuarios_nombre])
            ->andFilterWhere(['like', 'tbl_usuarios_apellido', $this->tbl_usuarios_apellido])
            ->andFilterWhere(['like', 'tbl_usuarios_email', $this->tbl_usuarios_email])
            ->andFilterWhere(['like', 'tbl_usuarios_telefono', $this->tbl_usuarios_telefono])
            ->andFilterWhere(['like', 'tbl_usuarios_rol', $this->tbl_usuarios_rol]);

        return $dataProvider;
    }
}