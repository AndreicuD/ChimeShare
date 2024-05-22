<?php

/** @var yii\web\View $this */
/* @var $model Chime */

use common\models\Chime;
use yii\bootstrap5\Html;

$this->title = 'Update chime | Chime Share';
$this->params['breadcrumbs'][] = Yii::t('app', 'Update chime');
?>


<div class="container">
    <?= $this->render('_chime', [
        'model' => $model,
        'read_only' => false,
    ]) ?>
</div>
