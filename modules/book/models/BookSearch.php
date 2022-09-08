<?php

namespace app\modules\book\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\book\models\Book;

/**
 * BookSearch represents the model behind the search form of `app\modules\book\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'publish_year', 'page_count'], 'integer'],
            [['title', 'publisher', 'epigraph', 'pickup_last_date'], 'safe'],
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
        $query = Book::find();

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
            'id' => $this->id,
            'author_id' => $this->author_id,
            'publish_year' => $this->publish_year,
            'page_count' => $this->page_count,
            'pickup_last_date' => $this->pickup_last_date,
        ]);

        $query->andFilterWhere(['ilike', 'title', $this->title])
            ->andFilterWhere(['ilike', 'publisher', $this->publisher])
            ->andFilterWhere(['ilike', 'epigraph', $this->epigraph]);

        return $dataProvider;
    }
}
