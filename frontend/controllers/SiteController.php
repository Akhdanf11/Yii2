<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Siswa;
use common\models\SiswaLogin;

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
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
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

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
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

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new Siswa;
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
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
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
