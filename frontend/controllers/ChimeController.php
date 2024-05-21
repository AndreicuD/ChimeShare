<?php

namespace frontend\controllers;

use common\models\ChimeLike;
use Yii;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Chime;
use yii\web\Response;

/**
 * Chime controller
 */
class ChimeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['listen'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * listen/view chime.
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionListen($id): string
    {
        $model = $this->findModel($id);

        return $this->render('listen', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new Chime();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageParam = 'p';
        $dataProvider->query->andWhere(['user_id' => Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Add a chime
     * @return string|Response
     */
    public function actionCreate(): string|Response
    {
        $model = new Chime();
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'The chime has been created.');
            return $this->redirect(['chime/update', 'id' => $model->public_id]);
        }

        return $this->render('create' ,[
            'model' => $model,
        ]);
    }

    /**
     * update chime.
     * @param $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id): Response|string
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->session->setFlash('success', 'The chime has been updated.');
            return $this->refresh();
        } else {
            Yii::$app->session->setFlash('error', 'There was an error saving the chime.');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * delete a chime.
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionDelete($id): string
    {
        $model = $this->findModel($id);
        if ($model->delete()) {
            ChimeLike::deleteAll(['chime_id' => $model->id]);
            Yii::$app->session->setFlash('success', 'The chime has been deleted.');
        }

        $this->redirect(['chime/index']);
    }

    /**
     * Finds the Chime based on its public_id value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id - the public_id of the model
     * @return array|Chime|ActiveRecord
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(string $id): array|Chime|ActiveRecord
    {
        if (($model = Chime::find()->where('public_id = :id', [':id' => $id])->andWhere(['user_id' => Yii::$app->user->id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested chime does not exist.'));
    }
}
