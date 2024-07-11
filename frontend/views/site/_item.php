<?php

use common\models\ChimeLike;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $widget yii\widgets\ListView this widget instance */
/* @var $modelLike common\models\ChimeLike */
/* @var $key mixed the key value associated with the data item */
/* @var $index integer the zero-based index of the data item in the items array returned by the data provider */
?>

<div class="container mt-3">
    <div class="card mb-3 chime_list_item" id="list_item">
        <div class="row align-items-center">
            <div class="col col-2">
                <button onclick='play_item_melody("<?= $model->public_id ?>-<?= $where ?>", "<?= $model->instrument ?>", "<?= $model->bpm ?>" )' class="btn btn-light play_btn" id="play-button-<?=$model->public_id?>-<?=$where?>">&#x25B6;</button>
                <p id="public-id-<?=$model->public_id?>-<?= $where ?>" style="display: none;"> <?= $model->content ?> </p>
            </div>
            <div class="col col-8 text-center info">
                <h5 class="mb-1"><a class='chime_title' href="<?= Url::toRoute(['chime/listen', 'id' => $model->public_id]); ?>"> <?= Html::encode($model->title) ?> </a></h5>
                <p class="mb-1">BPM: <span id="bpm"><?= Html::encode($model->bpm) ?></span></p>
                <p class="mb-1">Instrument: <span id="instrument"><?= $model::instrumentList()[ Html::encode($model->instrument)]; ?></span></p>
                <p class="like-count" data-chime="<?=$model->public_id?>">Likes: <span id="like_count"><?= Html::encode($model->likes_count) ?></span></p>
            </div>
            <div class="col col-2 like-btn">
                <?php $form = ActiveForm::begin([
                    'id' => 'form-like-'.$model->public_id, 
                    'action' => ['like/add'], 
                    'options' => [
                        'class'=>'form-like',
                        'data-chime' => $model->public_id,
                    ]
                ]); ?>
                    <?= $form->errorSummary($modelLike);?>
                    <?php $modelLike->public_chime_id = $model->public_id;?>
                    <?= Html::activeHiddenInput($modelLike, 'public_chime_id') ?>
                    <?= Html::hiddenInput('chime_current_page', Yii::$app->request->getUrl()); ?>

                    <button data-chime="<?=$model->public_id?>" type="submit" class="btn btn-light like_btn <?=($model->is_liked_by_user ? 'is_liked_by_user': ''); ?>">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-heart">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                        </svg>
                    </button>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
