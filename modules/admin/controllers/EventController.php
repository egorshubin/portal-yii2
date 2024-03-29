<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Event;
use app\models\search\EventSearch as EventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * EventController implements the CRUD actions for EventSearch model.
 */
class EventController extends Controller
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
     * Lists all EventSearch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new EventSearch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Event();

        $this->actionSave($model);

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EventSearch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->actionSave($model);
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $model
     * @return \yii\web\Response
     */
    protected function actionSave($model) {
        $post = Yii::$app->request->post();
        if ($docname = $this->actionUpload($model)) {
            if (!$post['Event']['document']) {
                $post['Event'] += ['document' => ''];
            }
            $postDoc = $post['Event']['document'];

            if ($postDoc != '' && $postDoc != null) {
                @unlink('uploads/' . $postDoc);
            }
            $post['Event']['document'] = $docname;
        }
        if ($model->load($post) && $model->save() && $model->saveCheckedIds($post['Event']['checkedIds'])) {
            return $this->redirect(['update', 'id' => $model->id]);
        }
    }

    /**
     * @param $model
     * @return bool
     */
    protected function actionUpload($model)
    {
        if (Yii::$app->request->isPost && $model->download = UploadedFile::getInstance($model, 'download')) {
            if ($name = $model->upload()) {
                // file is uploaded successfully

                return $name;
            }
        }
        return false;
    }

    /**
     * Deletes an existing EventSearch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $filename = $model->document;
        if ($filename != null && $filename != '') {
            @unlink('uploads/' . $filename);
        }
        $model->deleteFromCategoryEvent();
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
     * Finds the EventSearch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
