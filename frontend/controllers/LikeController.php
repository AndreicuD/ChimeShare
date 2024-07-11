<?php

namespace frontend\controllers;

use Yii;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\ChimeLike;
use common\models\Chime;
use yii\web\Response;

/**
 * Chime controller
 */
class LikeController extends Controller
{

    /**
     * Add a like, or remove it if already present
     * @return string|Response
     */
    public function actionAdd(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $return = ['success' => false, 'likes_count' => 0];
        if (!Yii::$app->user->isGuest) {
            if ($modelFindId = Chime::find()->where(['public_id' => $_POST['ChimeLike']['public_chime_id']])->one()) {
                $return['likes_count'] = $modelFindId->likes_count;
                if ($existing = ChimeLike::findOne(['chime_id' => $modelFindId->id, 'user_id' => Yii::$app->user->id])) {
                    $op = Yii::$app->db->createCommand()->delete(
                        'chime_like',
                        ['id' => $existing->id]
                    )->execute();
                } else {
                    $op = Yii::$app->db->createCommand()->insert(
                        'chime_like',
                        [
                            'chime_id' => $modelFindId->id,
                            'user_id' => Yii::$app->user->id,
                            'created_at' => date('Y-m-d h:m:s'),
                        ]
                    )->execute();
                }

                if ($op) {
                    if (!$existing) {
                        $modelFindId->updateCounters(['likes_count' => 1]);
                    } elseif ($modelFindId->likes_count >0 ) {
                        $modelFindId->updateCounters(['likes_count' => -1]);
                    }
                    $return['success'] = true;
                    $return['likes_count'] = $modelFindId->likes_count;
                }
                
            }
        } else {
            Yii::$app->session->setFlash('error', 'Please login to like a chime.');
            $this->redirect(Yii::$app->request->post('chime_current_page', 'site/index'));
        }

        return $return;
    }


        /**
     * Finds the Chime based on its public_id value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id - the public_id of the model
     * @return array|ChimeLike|ActiveRecord
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelPublic(string $id): array|ChimeLike|ActiveRecord
    {
        if (($model = ChimeLike::find()->where('public_id = :id', [':id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested chime does not exist.'));
    }
}
