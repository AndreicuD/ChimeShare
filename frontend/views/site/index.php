<?php

/** @var yii\web\View $this */
/* @var $latestDataProvider yii\data\ActiveDataProvider */

use yii\bootstrap5\Html;
use yii\widgets\ListView;

$this->registerJsFile('/js/tone.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/index_melody_play.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/melodyMaker.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$this->title = 'Chime Share';
?>
<div class="site-index">
    <div class="container my-3 hero">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6 hero-image">
                <img src="/img/screenshot-hero.png" class="d-block mx-lg-auto img-fluid img-thumbnail shadow-lg" alt="Hero Image" width="600" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3 page_title">Chime Share</h1>
                <p class="lead lh-1"><?= Yii::t('app', 'ChimeShare is an online web project dedicated to making music accesible to everyone, with a social twist.') ?></p>
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
                <h2 class="page_title"><?= Yii::t('app', 'Top Chimes'); ?></h2>
                <div style="text-align: center;">
                    <?= ListView::widget([
                        'dataProvider' => $bestDataProvider,
                        'id' => 'best_chimes',
                        'itemView' => '_item',
                        'viewParams' => ['modelLike'=> $modelLike, 'where' => 'best_chimes'],
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
            <div class="col-md-6">
                <h2 class="page_title"><?= Yii::t('app', 'Latest Chimes'); ?></h2>
                <div style="text-align: center;">
                    <?= ListView::widget([
                        'dataProvider' => $latestDataProvider,
                        'id' => 'latest_chimes',
                        'itemView' => '_item',
                        'viewParams' => ['modelLike'=> $modelLike, 'where' => 'latest_chimes'],
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
            <p class='page_title' style="text-align: center;">For more chimes please visit <a href="/chime/index">this page</a>!</p>
        </div>
    </div>
    <p class="small_gray_text" style="text-align: center;">The background was made using <a target="_blank" href="https://www.vantajs.com/?effect=fog">Vanta</a>. Check them out too!</p>
</div>

<?php
$js_text_processing = Yii::t('app', 'Processing');
$bottomJs = <<< JS
$(document).ready(function () {
    $(document).on('submit', 'form.form-like', function(event) {
        event.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            success: function (data) {
                //console.dir(data);
                var public_id = form.attr('data-chime');
                if (data.success == true) {
                    $('button.like_btn[data-chime="'+public_id+'"]').each(function(){
                        $(this).toggleClass('is_liked_by_user');
                    });
                    $('p.like-count[data-chime="'+public_id+'"] > strong > span').each(function(){
                        $(this).html(data.likes_count);
                        //console.dir(data.likes_count);
                    });
                }
            }
        });
    });
});
JS;
$this->registerJs($bottomJs, yii\web\View::POS_END);
?>