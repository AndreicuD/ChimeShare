<?php

/** @var yii\web\View $this */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap5\Html;
use yii\widgets\ListView;

$this->title = 'My chimes | Chime Share';
//$this->params['breadcrumbs'][] = Yii::t('app', 'My chimes');
?>
<div class="chime-index">
    <h1 style="text-align: center;" class="page_title">My Chimes</h1>
    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <?= Html::a('Add chime', ['chime/create'], ['class' => 'btn btn-success']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_item',
                    'options' => [
                        'tag' => 'div',
                        'class' => 'list-wrapper row',
                    ],
                    'itemOptions' => [
                        'tag' => 'div',
                        'class' => 'col-12',
                    ],
                    'layout' => '{items}{pager}',
                    'pager' => [
                        'pageCssClass' => 'page-item',
                        'prevPageCssClass' => 'prev page-item',
                        'nextPageCssClass' => 'next page-item',
                        'firstPageCssClass' => 'first page-item',
                        'lastPageCssClass' => 'last page-item',
                        'linkOptions' => ['class' => 'page-link'],
                        'disabledListItemSubTagOptions' => ['class' => 'page-link'],
                        'options' => ['class' => 'pagination justify-content-center'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
