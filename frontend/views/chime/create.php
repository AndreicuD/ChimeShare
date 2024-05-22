<?php

/** @var yii\web\View $this */
/* @var $model Chime */

use common\models\Chime;
use yii\bootstrap5\Html;

$this->title = 'Create chime | Chime Share';
//$this->params['breadcrumbs'][] = Yii::t('app', 'Create chime');
?>
<div class="container">
    <h1 style="text-align: center;">Chime Maker</h1>
    <?= $this->render('_chime', [
        'model' => $model,
        'read_only' => false,
    ]) ?>
</div>
