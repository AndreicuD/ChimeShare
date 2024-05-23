<?php

use yii\bootstrap5\Html;
use yii\helpers\HtmlPurifier;
use Yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $widget yii\widgets\ListView this widget instance */
/* @var $model common\models\Chime */
/* @var $key mixed the key value associated with the data item */
/* @var $index integer the zero-based index of the data item in the items array returned by the data provider */

?>
 
<a class="card mb-3" href="<?= Url::toRoute(['chime/listen', 'id' => $model->public_id]); ?>">
    <div class="title" style="width: 50%; float: left;"><?= Html::encode($model->title) ?></div>
    <div class="likes_count" style="width: 50%; float: left;"><?= $model->likes_count; ?></div>
</a>
