<?php

namespace app\modules\test_task\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\test_task\models\Books;

/**
 * BooksSearch represents the model behind the search form about `app\modules\test_task\models\Books`.
 */
class BooksSearch extends Books
{
    public $author;
    public $date_begin;
    public $date_end;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id'], 'integer'],
            [['date_begin', 'date_end', 'author', 'name', 'date_create', 'date_update', 'preview', 'date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Books::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /**
         * Настройка параметров сортировки
         * Важно: должна быть выполнена раньше $this->load($params)
         * statement below
         */
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'name',
                'author' => [
                    'asc' => ['lastname' => SORT_ASC, 'firstname' => SORT_ASC],
                    'desc' => ['lastname' => SORT_DESC, 'firstname' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'date',
                'date_create',
            ]
        ]);

        $query->joinWith(['authors']);

        if (!($this->load($params) && $this->validate())) {
            /**
             * Жадная загрузка данных модели Страны
             * для работы сортировки.
             */
            return $dataProvider;
        }

        $query->andFilterWhere([
            'books.id' => $this->id,
            //'date' => $this->date,
            'author_id' => $this->author_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        // Фильтр по полному имени
        $query->andWhere('authors.firstname LIKE "%' . $this->author . '%" ' .
            'OR authors.lastname LIKE "%' . $this->author . '%"'
        );

        // Фильтр по дате
        /*
         // Если на форме нужно воодить как на плейсхолдере
         $myDateTime= DateTime::createFromFormat('d/m/Y', $this->date_begin);
         $myDateTime->format('Y-m-d');
         */
        $query->andFilterWhere(['>=', 'date', $this->date_begin]);
        $query->andFilterWhere(['<=', 'date', $this->date_end]);

        return $dataProvider;
    }
}
