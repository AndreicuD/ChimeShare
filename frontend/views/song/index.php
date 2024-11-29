<?php

/** @var yii\web\View $this */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap5\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;

$this->title = 'Songs';
//$this->params['breadcrumbs'][] = Yii::t('app', 'Songs');
?>
<div class="songs-index">
    <h1 style="text-align: center;" class="page_title"><?= Yii::t('app', 'Songs'); ?></h1>
    <table class="songs_table">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Artist</th>
                <th scope="col">Guitar 1</th>
                <th scope="col">Guitar 2</th>
                <th scope="col">Bass</th>
                <th scope="col">Drums</th>
                <th scope="col">Piano</th>
                <th scope="col">Voice 1</th>
                <th scope="col">Voice 2</th>
            </tr>
        </thead>
        <tbody>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
                'viewParams' => [],
                'options' => [
                    'tag' => 'tr',
                ],
                'itemOptions' => [
                    'tag' => '',
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
        </tbody>
    </table>
    <div class="col-12">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
                'viewParams' => [],
                'options' => [
                    'tag' => 'div',
                    'class' => 'list-wrapper row',
                ],
                'itemOptions' => [
                    'tag' => 'div',
                    'class' => 'col-12 col-md-6 col-lg-4',
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