<?php

namespace backend\controllers;

use Yii;
use frontend\models\Siswa;
use backend\models\SiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SiswaController implements the CRUD actions for Siswa model.
 */
class SiswaController extends Controller
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
     * Lists all Siswa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SiswaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Siswa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Siswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Siswa();

        if ($model->load(Yii::$app->request->post())) {
            $model->password = Yii::$app->getSecurity()->generatePasswordHash(Yii::$app->request->post('Siswa')['password']);
            $model->id_kelas = Yii::$app->request->post('Siswa')['id_kelas'];
            $model->id_jurusan = Yii::$app->request->post('Siswa')['id_jurusan'];
            $model->no_telp = Yii::$app->request->post('Siswa')['no_telp'];
            $model->save();
            return $this->redirect(['view', 'id' => $model->nisn]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Siswa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->id_kelas = Yii::$app->request->post('Siswa')['id_kelas'];
            $model->id_jurusan = Yii::$app->request->post('Siswa')['id_jurusan'];
            $model->no_telp = Yii::$app->request->post('Siswa')['no_telp'];
            $model->img = UploadedFile::getInstance($model, 'img');
            $fileName = time(). '.' . $model->img->extension;
            $model->img->saveAs(Yii::getAlias('@gambarSiswaPath'). '/' . $fileName);
            $model->img = $fileName;
            $model->save();
            return $this->redirect(['view', 'id' => $model->nisn]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Siswa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Siswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Siswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Siswa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
