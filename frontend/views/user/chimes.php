<?php

/** @var yii\web\View $this */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap5\Html;
use yii\widgets\ListView;

$this->registerJsFile('/js/tone.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/index_melody_play.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/melodyMaker.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->title = Yii::t('app', 'My Chimes');
//$this->params['breadcrumbs'][] = Yii::t('app', 'My chimes');
?>
<div class="chime-index">
    <h1 style="text-align: center;" class="page_title"><?= Yii::t('app', 'My Chimes'); ?></h1>
    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <?= Html::a('Make a New Chime!', ['chime/create'], ['class' => 'btn btn-primary', 'style' => 'text-align: center; margin: auto;']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_chime',
                    'viewParams' => ['modelLike'=> $modelLike, 'where' => 'my_chimes'],
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
    </div>
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
                    $('p.like-count[data-chime="'+public_id+'"] > span').each(function(){
                        $(this).html(data.likes_count);
                    });
                }
            }
        });
    });
});
JS;
$this->registerJs($bottomJs, yii\web\View::POS_END);
?>