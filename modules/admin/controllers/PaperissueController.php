<?php

namespace app\modules\admin\controllers;

use app\models\Paper;
use Yii;
use app\models\Paperissue;
use app\models\search\PaperissueSearch as PaperissueSearch;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PaperissueController implements the CRUD actions for PaperissueSearch model.
 */
class PaperissueController extends Controller
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

    public function actionLoadbyyear() {
        if ($request = Yii::$app->request->post('data')) {
            $request_array = explode('/', $request);
            $year = $request_array[0];
            $id = $request_array[1];

            $paperissues = \yii::$app->db->createCommand("SELECT id, title FROM paperissue WHERE year_f = " . $year. " AND paper_id = " . $id . " ORDER BY month_f DESC")->queryAll();

            $string = '';

            foreach ($paperissues as $paperissue) {
                $string .= '<li class="papers-list-item">';
                $string .= Html::a('<i class="edit-icon fa fa-pencil" aria-hidden="true"></i>' . $paperissue['title'], ['/admin/paperissue/update', 'id' => $paperissue['id'], 'paper_id' => $id], ['title' => 'Редактировать']);
                $string .= Html::a('<i class="delete-paper-icon fa fa-trash gray delete-forever"></i>', ['/admin/paperissue/delete', 'id' => $paperissue['id'], 'paper_id' => $id], ['title' => 'Удалить']);
                $string .= '</li>';
            }

            return $string;
        }
    }

    /**
     * Creates a new PaperissueSearch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($paper_id = null)
    {
        $model = new Paperissue();

        $this->actionSave($model);

        $paper_title = Paper::findOne($paper_id)->title;

        return $this->render('create', [
            'model' => $model,
            'paper_id' => $paper_id,
            'paper_title' => $paper_title
        ]);
    }

    /**
     * Updates an existing PaperissueSearch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $paper_id = null)
    {
        $model = $this->findModel($id);
        $this->actionSave($model);

        $paper_title = Paper::findOne($paper_id)->title;
        return $this->render('update', [
            'model' => $model,
            'paper_id' => $paper_id,
            'paper_title' => $paper_title
        ]);
    }

    /**
     * @param $model
     * @return \yii\web\Response
     */
    protected function actionSave($model) {
        $post = Yii::$app->request->post();
        if ($docname = $this->actionUpload($model)) {
            if (!$post['Paperissue']['document']) {
                $post['Paperissue'] += ['document' => ''];
            }
            $postDoc = $post['Paperissue']['document'];
            if ($postDoc != '' && $postDoc != null) {
                @unlink('papers/' . $postDoc);
            }
            $post['Paperissue']['document'] = $docname;

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
     * Deletes an existing PaperissueSearch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $paper_id)
    {
        $model = $this->findModel($id);
        $filename = $model->document;
        if ($filename != null && $filename != '') {
            @unlink('papers/' . $filename);
        }
        $model->delete();

        return $this->redirect(['paper/update', 'id' => $paper_id]);
    }

    /**
     * Finds the PaperissueSearch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Paperissue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Paperissue::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
