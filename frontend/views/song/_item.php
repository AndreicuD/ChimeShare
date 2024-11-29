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
            <p class="mb-1">Title: <strong><span id="song_title"><?= Html::encode($model->title) ?></span></strong></p>
        </div>
    </div>
</div>
