<?php


namespace app\models\search;

use app\models\Category as CategoryModel;
use app\models\Event as EventModel;
use app\models\Webinar as WebinarModel;
use app\models\Paper as PaperModel;
use app\models\Webinar;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\db\Query;

class CategoryChildrenSearch extends ActiveRecord
{

    public function search($category_id)
    {
        $query1 = $this->customQueryBuilder(EventModel::find(), 'event', $category_id, 'categoryEvents');
        $query2 = $this->customQueryBuilder(WebinarModel::find(), 'webinar', $category_id, 'categoryWebinars');
        $query3 = $this->customQueryBuilder(PaperModel::find(), 'paper', $category_id, 'categoryPapers');
//        $query4 = $this->customQueryBuilder(CategoryModel::find(), 'category', $category_id, 'categoryCategories');

        $query1->union($query2)->union($query3)
//            ->union($query4)
        ;

        $dataProvider = new ActiveDataProvider([
            'query' => $query1,
        ]);

        return $dataProvider;
    }

    private function customQueryBuilder($query, $table, $category_id, $relation){
        $query
            ->addSelect($table . '.id as id')
            ->addSelect('title')
            ->addSelect('status_id')
            ->addSelect('type_f')
            ->innerJoinWith($relation)
            ->where('category_' . $table . '.parent_id=:category_id')
            ->addParams([':category_id' => $category_id])
            ->orderBy('arrangement ASC')
            ->all()
        ;

        return $query;
    }
}