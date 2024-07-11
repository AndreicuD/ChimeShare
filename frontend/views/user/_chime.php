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
                <button onclick='play_item_melody("<?= $model->public_id ?>-<?= $where ?>", "<?= $model->instrument ?>", "<?= $model->bpm ?>" )' class="play_btn icon_btn" id="play-button-<?=$model->public_id?>-<?=$where?>">&#x25B6;</button>
                <p id="public-id-<?=$model->public_id?>-<?= $where ?>" style="display: none;"> <?= $model->content ?> </p>
            </div>
            <div class="col col-8 text-center info">
                <h5 class="mb-1"><a class='chime_title' href="<?= Url::toRoute(['chime/listen', 'id' => $model->public_id]); ?>"> <?= Html::encode($model->title) ?> </a></h5>
                <h5 class="mb-1"><?= Yii::t('app', 'by') ?> <strong><?= $model->user->full_name ?? '' ?></strong></h5>
                <p class="mb-1">BPM: <strong><span id="bpm"><?= Html::encode($model->bpm) ?></span></strong></p>
                <p class="mb-1"><?= Yii::t('app', 'Instrument:') ?> <strong><span id="instrument"><?= $model::instrumentList()[ Html::encode($model->instrument)]; ?></span></strong></p>
                <p class="like-count" data-chime="<?=$model->public_id?>">Likes: <strong><span id="like_count"><?= Html::encode($model->likes_count) ?></span></strong></p>
                <p class="mb-1"><?= Yii::t('app', 'Is public:') ?> <strong><span id="visibility"><?= $model->public ? Yii::t('app', 'Yes') : Yii::t('app', 'No') ?></span></strong></p>
            </div>
            <div class="col col-2">
                <button onclick="openPopup('update_chime_popup-<?=$model->public_id?>')" class="icon_btn">
                    <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M6 4v4" /><path d="M6 12v8" /><path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M12 4v10" /><path d="M12 18v2" /><path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M18 4v1" /><path d="M18 9v11" /></svg>
                </button>
                <button onclick="openPopup('delete_chime_popup-<?=$model->public_id?>')" class="icon_btn trash_btn">
                    <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- update chime popup -->
<div id="update_chime_popup-<?=$model->public_id?>">
    <div class="overlay_opaque" onclick="closePopup('update_chime_popup-<?=$model->public_id?>')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'Update Chime') ?></h1>
        <?php $form_update = ActiveForm::begin(['id' => 'form-updatechime_'.$model->public_id, 'layout' => 'floating', 'action' => ['chime/update', 'id' => $model->public_id]]); ?>

        <?= $form_update->errorSummary($model);?>

        <?= $form_update->field($model, 'title')->label(Yii::t('app', 'Give the chime a title!')) ?>
        <?= $form_update->field($model, 'public')->checkbox(['uncheck' => '0', 'value' => '1']); ?>

        <br>    
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <button onclick="closePopup('update_chime_popup-<?=$model->public_id?>')" type="button" class="btn btn-danger"><?= Yii::t('app', 'Close') ?></button>
                </div>
                <div class="col">
                    <input type="submit" value="Save" class="btn btn-success">
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<!-- erase chime popup -->
<div id="delete_chime_popup-<?=$model->public_id?>">
    <div class="overlay_opaque" onclick="closePopup('delete_chime_popup-<?=$model->public_id?>')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'Delete Chime') ?></h1>
        <div style="text-align: center;">
            <p><?= Yii::t('app', 'This will delete the chime:') ?></p>
            <h3><strong><?= Html::encode($model->title) ?></strong></h3>
            <br>
            <p><?= Yii::t('app', 'Are you sure you want to continue?') ?></p>
        </div>
        <br>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <button onclick="closePopup('delete_chime_popup-<?=$model->public_id?>')" type="button" class="btn btn-success"><?= Yii::t('app', 'No') ?></button>
                </div>
                <div class="col">
                    <a href="<?= Url::toRoute(['chime/delete', 'id' => $model->public_id]); ?>" class="btn btn-danger"><?= Yii::t('app', 'Yes') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
