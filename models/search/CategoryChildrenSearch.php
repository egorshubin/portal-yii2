<?php


namespace app\models\search;

use app\models\Category as CategoryModel;
use app\models\Event as EventModel;
use app\models\Webinar as WebinarModel;
use app\models\Paper as PaperModel;
use app\models\Webinar;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Query;

class CategoryChildrenSearch extends ActiveRecord
{

    public function search($category_id)
    {
        $query1 = $this->customQueryBuilder(EventModel::find(), EventModel::tableName(), $category_id, 'categoryEvents');
        $query2 = $this->customQueryBuilder(WebinarModel::find(), WebinarModel::tableName(), $category_id, 'categoryWebinars');
        $query3 = $this->customQueryBuilder(PaperModel::find(), PaperModel::tableName(), $category_id, 'categoryPapers');
//        $query4 = $this->customQueryBuilder(CategoryModel::find(), CategoryModel::tableName(), $category_id, 'categoryCategories');

//        $query1->union($query2)->union($query3)
//            ->union($query4);


        $query = (new Query())
            ->select('*')
        ->from($query1->union($query2)->union($query3))->orderBy('arrangement ASC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $dataProvider;
    }

    private function customQueryBuilder($query, $table, $category_id, $relation){
        $query
            ->addSelect($table . '.id as id')
            ->addSelect('title')
            ->addSelect('status_id')
            ->addSelect('type_f')
            ->addSelect('arrangement')
            ->addSelect('type.db_name as type')
            ->innerJoinWith('typeF')
            ->where('type.id = ' . $table . '.type_f')
            ->innerJoinWith($relation)
            ->where('category_' . $table . '.parent_id=:category_id')
            ->addParams([':category_id' => $category_id])
            ->all()
        ;

        return $query;
    }
}