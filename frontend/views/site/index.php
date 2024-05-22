<?php

/** @var yii\web\View $this */
@var $dataProvider yii\data\ActiveDataProvider;

use yii\widgets\ListView;

$this->title = 'Chime Share';
?>
<div class="site-index">
    <div class="container my-3">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="/img/screenshot-hero.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3 page_title">Chime Share</h1>
                <p class="lead">ChimeShare is an online web project dedicated to making music accesible to everyone, with a social twist.</p>
                <!--<div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4">View your dashboard</button>
                </div>-->
            </div>
        </div>
    </div>
    <div class="shadow_divider"></div>
    <div class="container my-3">
        <div class="row">
            <div class="col-md-6">
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
            <div class="col-md-6">
                <p>altceva</p>
            </div>
        </div>
    </div>
</div>
