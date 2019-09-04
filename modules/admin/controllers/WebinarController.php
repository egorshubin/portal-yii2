<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Webinar;
use app\models\search\WebinarSearch as WebinarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * WebinarController implements the CRUD actions for WebinarSearch model.
 */
class WebinarController extends Controller
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
     * Lists all WebinarSearch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WebinarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new WebinarSearch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Webinar();

        $this->actionSave($model);

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing WebinarSearch model.
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
            if (!$post['Webinar']['video']) {
                $post['Webinar'] += ['video' => ''];
            }
            $postDoc = $post['Webinar']['video'];
            if ($postDoc != '' && $postDoc != null) {
                @unlink('webinars/' . $postDoc);
            }
            $post['Webinar']['video'] = $docname;

        }
        if ($model->load($post) && $model->save() && $model->saveCheckedIds($post['Webinar']['checkedIds'])) {
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
     * Deletes an existing WebinarSearch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $filename = $model->video;
        if ($filename != null && $filename != '') {
            @unlink('webinars/' . $filename);
        }

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
     * Finds the WebinarSearch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Webinar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Webinar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
