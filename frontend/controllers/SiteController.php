<?php

namespace frontend\controllers;

use frontend\models\ContactForm;
use Yii;
use yii\web\Controller;
use common\models\Chime;

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
        $latestDataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $latestDataProvider->pagination->pageParam = 'p';
        $latestDataProvider->query->orderBy(['id' => SORT_DESC]);
        $latestDataProvider->query->limit(5);
        $latestDataProvider->query->andFilterWhere(['public' => 1, 'active' => 1]);

        $searchModel2 = new Chime();
        $bestDataProvider = $searchModel2->search(Yii::$app->request->queryParams);
        $bestDataProvider->pagination->pageParam = 'p';
        $bestDataProvider->query->orderBy(['likes_count' => SORT_DESC]);
        $bestDataProvider->query->limit(5);
        $bestDataProvider->query->andFilterWhere(['public' => 1, 'active' => 1]);

        return $this->render('index', [
            'latestDataProvider' => $latestDataProvider,
            'bestDataProvider' => $bestDataProvider,
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
