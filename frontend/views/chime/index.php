<?php

/** @var yii\web\View $this */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap5\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;

$this->registerJsFile('/js/tone.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/index_melody_play.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/melodyMaker.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->title = 'All chimes';
//$this->params['breadcrumbs'][] = Yii::t('app', 'All Chimes');
?>
<div class="chime-index">
    <h1 style="text-align: center;" class="page_title"><?= Yii::t('app', 'All Chimes'); ?></h1>
    <div class="container my-3">
        <div class="row mb-3">

            <div class="col-6">
                <div class="input-group pe-2">
                    <button id="instrument_selector_button" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $searchModel::instrumentList()[$searchModel->instrument] ?? Yii::t('app', 'Instrument'); ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?=Html::a(Yii::t('app', 'See all'), ['chime/index'], ['class' => 'dropdown-item user-select-none']); ?></li>
                        <?php foreach($searchModel::instrumentList() as $instrument => $instrument_name) { ?>
                            <li><?=Html::a($instrument_name, Url::to(['chime/index']).'/'.$instrument, ['class' => 'dropdown-item user-select-none']); ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
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