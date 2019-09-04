<?php

namespace app\modules\admin\controllers;

use app\models\search\CategoryChildrenSearch;
use Yii;
use app\models\Category;
use app\models\search\CategorySearch as CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for CategorySearch model.
 */
class CategoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CategorySearch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new CategorySearch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CategorySearch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        $searchModel = new CategoryChildrenSearch();
        $dataProvider = $searchModel->search($model->id);

        return $this->render('update', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing CategorySearch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $dbsArray = [
            'category_category', 'category_event', 'category_paper', 'category_webinar'
        ];
        foreach ($dbsArray as $db) {
            \yii::$app->db->createCommand("DELETE FROM " . $db . " WHERE parent_id = :id", [':id' => $id])->execute();
        }
        \yii::$app->db->createCommand("DELETE FROM category_category WHERE unit_id = :id", [':id' => $id])->execute();

        return $this->redirect(['index']);
    }

    public function actionPublish($id, $redirect) {
        $model = $this->findModel($id);
        $model->status_id = 1;
        if ($model->save()) {
            return $this->redirect([$redirect]);
        }
    }

    public function actionUnpublish($id, $redirect) {
        $model = $this->findModel($id);
        $model->status_id = 0;
        if ($model->save()) {
            return $this->redirect([$redirect]);
        }
    }

    public function actionPublishfromcat($id, $redirect, $categoryId, $tableName) {
        $modelName = ucfirst($tableName);
        $modelName = 'app\\models\\' . $modelName;
        $model = new $modelName();
        $model = $model::findOne($id);
        $model->status_id = 1;
        if ($model->save()) {
            return $this->redirect([$redirect, 'id' => $categoryId]);
        }
    }

    public function actionUnpublishfromcat($id, $redirect, $categoryId, $tableName) {
        $modelName = ucfirst($tableName);
        $modelName = 'app\\models\\' . $modelName;
        $model = new $modelName();
        $model = $model::findOne($id);
        $model->status_id = 0;
        if ($model->save()) {
            return $this->redirect([$redirect, 'id' => $categoryId]);
        }
    }

    public function actionOffcategory($id, $redirect, $categoryId, $tableName) {
        $relModelName = 'app\models\Category' . ucfirst($tableName);
        $relModel = new $relModelName();
        $row = $relModel::find()
            ->where('unit_id = ' . $id)
            ->andWhere('parent_id = ' . $categoryId)
            ->one()
            ->delete();

        return $this->redirect([$redirect, 'id' => $categoryId]);
    }

    public function actionReorder() {
        if ($params = Yii::$app->request->getBodyParams()) {
            $request_array = explode('/', $params['data']);
            foreach ($request_array as $row) {
                $row_array = explode(',', $row);
                $modelName = ucfirst($row_array[1]);
                $modelName = 'app\\models\\' . $modelName;
                $model = new $modelName();
                $model = $model::findOne($row_array[0]);
                $model->arrangement = $row_array[2];
                $model->save();
            }
            $this->redirect(['/admin/category/update', 'id' => $params['categoryId']]);
        }
    }

    /**
     * Finds the CategorySearch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
