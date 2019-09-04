<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Manager;
use app\models\search\ManagerSearch as ManagerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ManagerController implements the CRUD actions for ManagerSearch model.
 */
class ManagerController extends Controller
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
     * Lists all ManagerSearch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ManagerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ManagerSearch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Manager();

        $this->actionSave($model);

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ManagerSearch model.
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
            if (!$post['Manager']['image']) {
                $post['Manager'] += ['image' => ''];
            }
            $postDoc = $post['Manager']['image'];
            if ($postDoc != '' && $postDoc != null) {
                @unlink('manager_images/' . $postDoc);
                @unlink('manager_images/original/' . $postDoc);
            }
            $post['Manager']['image'] = $docname;

        }

        if ($model->load($post) && $model->save()) {
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
     * Deletes an existing ManagerSearch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $filename = $model->image;
        if ($filename != null && $filename != '') {
            @unlink('manager_images/' . $filename);
            @unlink('manager_images/original/' . $filename);
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
     * Finds the ManagerSearch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Manager the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Manager::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
