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
            <div class="col col-1   ">
                <button onclick='play_item_melody("<?= $model->public_id ?>-<?= $where ?>", "<?= $model->instrument ?>", "<?= $model->bpm ?>" )' class="btn btn-light play_btn" id="play-button-<?=$model->public_id?>-<?=$where?>">&#x25B6;</button>
                <p id="public-id-<?=$model->public_id?>-<?= $where ?>" style="display: none;"> <?= $model->content ?> </p>
            </div>
            <div class="col col-8 text-center info">
                <h5 class="mb-1"><a class='chime_title' href="<?= Url::toRoute(['chime/listen', 'id' => $model->public_id]); ?>"> <?= Html::encode($model->title) ?> </a></h5>
                <p class="mb-1">BPM: <span id="bpm"><?= Html::encode($model->bpm) ?></span></p>
                <p class="mb-1">Instrument: <span id="instrument"><?= $model::instrumentList()[ Html::encode($model->instrument)]; ?></span></p>
                <p class="like-count" data-chime="<?=$model->public_id?>">Likes: <span id="like_count"><?= Html::encode($model->likes_count) ?></span></p>
            </div>
        </div>
    </div>
</div>
