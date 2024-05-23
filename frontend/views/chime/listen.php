<?php

/** @var yii\web\View $this */
/* @var $model Chime */

use common\models\Chime;
use yii\bootstrap5\Html;

$this->title = 'Listen chime | Chime Share';
$this->params['breadcrumbs'][] = Yii::t('app', 'Listen chime');
?>


<div class="container">
    <?= $this->render('_chime', [
        'model' => $model,
        'read_only' => false,
    ]) ?>
    <?= Html::hiddenInput('chime_action', 'listen', ['id'=>'chime_action']); ?>
</div>
