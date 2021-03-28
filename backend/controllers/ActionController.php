<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Spp;
use common\models\User;
use frontend\models\Siswa;
use frontend\models\Jurusan;
use yii\web\Response;

/**
 * Site controller
 */
class ActionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['get-siswa', 'get-diagram'],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['get-siswa', 'get-diagram'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    // 'get-siswa' => ['post'],
                    // 'get-diagram' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionGetSiswa()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;

        if ($req->isAjax) {
            $data = Siswa::find()->select('nisn, nama')->where(['id_kelas' => $req->post("class"), 'id_jurusan' => $req->post("skill")])->all();
            if ($data) {
                return $response = [
                    'siswa' => $data
                ];
            } else {
                return $response = [
                    'siswa' => false
                ];
            }
        }

        
    }

    public function actionGetSiswaHistory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;

        if ($req->isAjax) {
            $data = (new \yii\db\Query())
            ->select("spp.created_at, spp.nominal, siswa.nama, kelas.nama AS nama_kelas, jurusan.nama AS nama_jurusan")
            ->from('spp')
            ->leftJoin('siswa', 'siswa.nisn = spp.nisn')
            ->leftJoin('jurusan', 'jurusan.id = siswa.id_jurusan')
            ->leftJoin('kelas', 'kelas.id = siswa.id_kelas')
            ->where(['spp.nisn' => $req->post("nisn")])
            ->all();

            if($data) {
                return $response = [
                    'data' => $data,
                ];
            } else {
                return $response = [
                    'data' => false
                ];
            }
        }
    }

    public function actionGetRangeHistory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;

        if ($req->isAjax) {

            $data = (new \yii\db\Query())
            ->select("spp.created_at, spp.nominal, siswa.nama, kelas.nama AS nama_kelas, jurusan.nama AS nama_jurusan")
            ->from('spp')
            ->leftJoin('siswa', 'siswa.nisn = spp.nisn')
            ->leftJoin('jurusan', 'jurusan.id = siswa.id_jurusan')
            ->leftJoin('kelas', 'kelas.id = siswa.id_kelas')
            ->andWhere(['between', 'spp.created_at', $req->post('date1'), $req->post('date2')])
            ->all();

            
            return $response = [
                'data' => $data,
                'date1' => $req->post('date1'),
                'date2' => $req->post('date2'),
            ];
        }
    }

    public function actionGetAllHistory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;

        if ($req->isAjax) {
            $data = (new \yii\db\Query())
            ->select("spp.created_at, spp.nominal, siswa.nama, kelas.nama AS nama_kelas, jurusan.nama AS nama_jurusan")
            ->from('spp')
            ->leftJoin('siswa', 'siswa.nisn = spp.nisn')
            ->leftJoin('jurusan', 'jurusan.id = siswa.id_jurusan')
            ->leftJoin('kelas', 'kelas.id = siswa.id_kelas')
            ->all();

            if($data) {
                return $response = [
                    'data' => $data,
                ];
            } else {
                return $response = [
                    'data' => false
                ];
            }
        }
    }

    
}
