<?php

namespace frontend\controllers;

use frontend\models\ContactForm;
use Yii;
use yii\web\Controller;
use common\models\Chime;
use common\models\ChimeLike;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
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
        $searchModel = new Chime();
        $latestDataProvider = $searchModel->searchLatest();

        $searchModel2 = new Chime();
        $bestDataProvider = $searchModel2->searchTop();
        
        $modelLike = new ChimeLike();

        return $this->render('index', [
            'latestDataProvider' => $latestDataProvider,
            'bestDataProvider' => $bestDataProvider,
            'modelLike' => $modelLike,
        ]);
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
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }
}
