<?php
namespace frontend\controllers;

use backend\models\Petugas;
use Yii;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\ResetPasswordForm;
use frontend\models\Skills;
use frontend\models\ContactForm;
use frontend\models\Personal;
use frontend\models\Siswa;
use frontend\models\Classes;
use frontend\models\PasswordReset;
use frontend\models\Contact;
use common\models\SiswaLogin;
use frontend\models\ChangePassword;

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
                'only' => ['logout', 'signup', 'index', 'contact', 'about'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'contact', 'about'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
            Petugas::find()->where(['level'=>'admin'])->one();
            $social = Petugas::find()->where(['whatsapp'=>'089505707449'])->one();
            return $this->render('index', [
                'Social' => $social,
            ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = "maintwo";

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if (Yii::$app->request->post()) {

            $check = Siswa::find()->where(['nisn' => Yii::$app->request->post("LoginForm")['nisn']])->one();

            if($check && Yii::$app->getSecurity()->validatePassword(Yii::$app->request->post('LoginForm')['password'], $check['password'])) {

                $model->login((new SiswaLogin)->findByNISN($check['nisn']));

                return $this->redirect(['site/index']);
            } else {
                Yii::$app->session->setFlash('danger', 'NISN Or Password Are Wrong.');

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

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionProfil()
    {
        if (Yii::$app->request->post()) {
            $data = Personal::find()->where(["nisn" => Yii::$app->user->identity->nisn])->one();

            $data->nisn = Yii::$app->user->identity->nisn;
            $data->nama = Yii::$app->request->post('Personal')['nama'];
            $data->id_kelas = Yii::$app->request->post('Classes')['id'];
            $data->id_jurusan = Yii::$app->request->post('Skills')['id'];
            $data->alamat = Yii::$app->request->post('Personal')['alamat'];
            $data->no_telp = Yii::$app->request->post('Personal')['no_telp'];
            // $data->img = Yii::$app->request->post('Personal')['img'];
            $data->save();
            return $this->render('profil', [
                'profil' => true,
                'data' => $data,
            ]);
        }

        $data = Personal::find()->where(["nisn" => Yii::$app->user->identity->nisn])->one();
        $myClass = Classes::find()->where(['id' => $data['id_kelas']])->one();
        $mySkill = Skills::find()->where(['id' => $data['id_jurusan']])->one();
        $class = Classes::find()->all();
        $skill = Skills::find()->all();

        return $this->render('profil', [
            'data' => $data,
            'class' => $class,
            'skill' => $skill,
            'mySkill' => $mySkill,
            'myClass' => $myClass,
        ]);

    }

    public function actionAccount()
    {
        $password = new PasswordReset;
        $data = Personal::find()->where(["nisn" => Yii::$app->user->identity->nisn])->one();
        if (Yii::$app->request->post()) {

            if (Yii::$app->request->post('PasswordReset')['password_2']) {
                $data = ChangePassword::find()->where(["nisn" => Yii::$app->user->identity->nisn])->one();

            if ($data['password'] != "") {

                if(Yii::$app->getSecurity()->validatePassword(Yii::$app->request->post('PasswordReset')['password'],
                $data['password'])){
                        $data->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('PasswordReset')['password_2']);
                        $data->save();
                        return $this->render('account',[
                            'passwordupdate' => true,
                            'data' => $data,
                            'pass' => $password,
                        ]);

                    }
                } 
            }
        }

        $old = $data['password'] != "" ? false : true;

        return $this->render('account',[
            'data' => $data,
            'pass' => $password,
            'old' => $old,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if (Yii::$app->request->post()) {
            $data = new Contact;
            $data->nisn = Yii::$app->user->identity->nisn;
            $data->keluhan = Yii::$app->request->post("ContactForm")['body'];
            $data->save();
            return $this->render('contact', [
                'model' => $model,
                'createcontact' => true,
            ]);
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }



    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRiwayat()
    {
        return $this->render('riwayat');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new Siswa;
        $this->layout = "maintwo";
        if (Yii::$app->request->post()) {

            Yii::$app->session->setFlash('success', 'Thank you for registration');
            $student = new Siswa;

            $student->nisn = Yii::$app->request->post('Siswa')['nisn'];
            $student->nis = Yii::$app->request->post('Siswa')['nis'];
            $student->nama = Yii::$app->request->post('Siswa')['nama'];
            $student->password = Yii::$app->getSecurity()->generatePasswordHash(Yii::$app->request->post('Siswa')['password']);
            $student->id_kelas = Yii::$app->request->post('Siswa')['id_kelas'];
            $student->id_jurusan = Yii::$app->request->post('Siswa')['id_jurusan'];
            $student->alamat = Yii::$app->request->post('Siswa')['alamat'];
            $student->no_telp = Yii::$app->request->post('Siswa')['no_telp'];
            $student->save();

            return $this->redirect(["site/login"]);

        } else {
            return $this->render('signup', [
                'model' => $model,
            ]);
        }
        
    }
    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
    
        public function actionRegister()
        {
            $model = new Siswa();
            $title = 'Register';
            // if ($model->load(Yii::$app->request->post())) {
                // if ($model->validate()) {
                //    $model->nisn =  $req->post("Siswa")['nisn'];
                //    $model->nis =  $req->post("Siswa")['nis'];
                //    $model->nama =  $req->post("Siswa")['nama'];
                //    $model->alamat =  $req->post("Siswa")['alamat'];
                //    $model->no_telp =  $req->post("Siswa")['no_telp'];
                //    $model->password =  password_hash($req->post("Siswa")['password'], PASSWORD_ARGON2I);
                //    if($model->save()){
                //     return $this->redirect((['login']));
                //    }
                // }
            // }

            return $this->render('register', [
                'model' => $model,
            ]);
        }
}
