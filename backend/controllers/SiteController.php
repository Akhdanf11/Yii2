<?php
namespace backend\controllers;

use backend\models\Petugas;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\Spp;
use common\models\LoginFormPetugas;
use common\models\PetugasLogin;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'signup'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'pembayaran'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionPembayaran()
    {
        $model = new Spp;

        if (Yii::$app->request->post()) {
            $model->nisn = Yii::$app->request->post("nama-siswa");
            $model->nominal = Yii::$app->request->post("Spp")['nominal'];
            $model->save();
            Yii::$app->session->setFlash('success', 'Anda Telah Berhasil Melakukan Pembayaran');

            return $this->render('pembayaran', [
                'model' => $model
            ]);
        }

        return $this->render('pembayaran', [
            'model' => $model
        ]);
    }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = "maintwo";

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginFormPetugas();
        if (Yii::$app->request->post()) {

            $check = PetugasLogin::find()->where(['username' => Yii::$app->request->post("LoginFormPetugas")['username']])->one();

            if($check && Yii::$app->getSecurity()->validatePassword(Yii::$app->request->post('LoginFormPetugas')['password'], $check['password'])) {

                
                    // return var_dump($model->login($check));
                    $model->login($check);
                
                return $this->redirect(['site/index']);
            } else {
                Yii::$app->session->setFlash('danger', 'USERNAME Or Password Are Wrong.');

                return $this->render('login', [
                    'model' => $model,
                ]);
            }

        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionSignup()
    {
        $model = new Petugas;
        $this->layout = "maintwo";
        if (Yii::$app->request->post()) {

            Yii::$app->session->setFlash('success', 'Thank you for registration');
            $petugas = new Petugas;

            $petugas->username = Yii::$app->request->post('Petugas')['username'];
            $petugas->level = Yii::$app->request->post('Petugas')['level'];
            $petugas->nama_petugas = Yii::$app->request->post('Petugas')['nama_petugas'];
            $petugas->password = Yii::$app->getSecurity()->generatePasswordHash(Yii::$app->request->post('Petugas')['password']);
            $petugas->level = Yii::$app->request->post('Petugas')['level'];
            $petugas->save();

            return $this->redirect(["site/login"]);

        } else {
            return $this->render('signup', [
                'model' => $model,
            ]);
        }
        
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
