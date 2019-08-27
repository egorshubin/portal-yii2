<?php

namespace app\controllers;

use app\models\search\CategorySearch as CategorySearch;
use Yii;

class CategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
