<?php

namespace app\modules\admin\controllers;

use app\models\Paperyear;
use Yii;
use app\models\Paper;
use app\models\search\PaperSearch as PaperSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaperController implements the CRUD actions for PaperSearch model.
 */
class PaperController extends Controller
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
     * Lists all PaperSearch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaperSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new PaperSearch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Paper();

        $this->actionSave($model);

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PaperSearch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $this->actionSave($model);

        $years = \yii::$app->db->createCommand("SELECT year_f FROM paper_year ORDER BY year_f DESC")->queryAll();
        $paperissues = \yii::$app->db->createCommand("SELECT id, title FROM paperissue WHERE year_f = " . $years[0]['year_f'] . " ORDER BY month_f DESC")->queryAll();

        return $this->render('update', [
            'model' => $model,
            'years' => $years,
            'paperissues' => $paperissues
        ]);
    }

    /**
     * @param $model
     * @return \yii\web\Response
     */
    protected function actionSave($model) {
        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->save() && $model->saveCheckedIds($post['Paper']['checkedIds'])) {
            return $this->redirect(['update', 'id' => $model->id]);
        }
    }

    /**
     * Deletes an existing PaperSearch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleteFromCategoryPaper();
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @param $redirect
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionPublish($id, $redirect) {
        $model = $this->findModel($id);
        $model->status_id = 1;
        if ($model->save()) {
            return $this->redirect([$redirect]);
        }
    }

    /**
     * @param $id
     * @param $redirect
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUnpublish($id, $redirect) {
        $model = $this->findModel($id);
        $model->status_id = 0;
        if ($model->save()) {
            return $this->redirect([$redirect]);
        }
    }

    /**
     * Finds the PaperSearch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Paper the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Paper::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
