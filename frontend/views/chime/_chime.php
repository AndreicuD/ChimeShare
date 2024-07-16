<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/* @var $this yii\web\View */

$this->registerJsFile('/js/tone.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('/js/melodyMaker.js', ['depends' => [\yii\web\JqueryAsset::class]]);

// the number of columns in the grid
$cols=32;

// the number of rows in the grid
$rows=24;

// the positions for the black piano keys
$black_keys = array("2", "4", "6", "9", "11", "14", "16", "18", "21", "23");

$button_classes= "";
?>

<div id="music_interface" class="button_interface">
    <?php for($i=1; $i<=$rows; $i++) { ?>
        <div class="row">
            <?php for($j=0; $j<=$cols; $j++) { ?>
                <?php if($j==0) {
                    if(in_array($i, $black_keys)) {
                        $button_classes = "piano_key piano_key_black";
                    } else {
                        $button_classes = "piano_key piano_key_white";
                    }
                } else {
                    $the_note = ($j + 8) % 8;
                    if ($the_note == 0) {
                        $the_note = 8;
                    }
                    $button_classes = "note_$the_note";
                } ?>
                <button onclick="check_cell(c<?=$j?>r<?=$i?>)" class="<?=$button_classes?> col cell" id="c<?=$j?>r<?=$i?>" data-duration="<?= $j > 0 ? 0 : ''?>"></button>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<div id="bottom_settings" class="container mb-3 p-0 pt-3">
    <div class="btn-toolbar justify-content-between bottom_settings_bar" role="toolbar" aria-label="Bottom toolbar">
        <div class="btn-group me-auto" role="group">
            <button class="icon_btn play_btn" id="play_button" onclick="playMelody()">&#x25B6;</button>
        </div>
        <div class="input-group pe-2">
            <button id="instrument_selector_button" type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $model::instrumentList()[$model->instrument] ?? Yii::t('app', 'Instrument'); ?>
            </button>
            <ul class="dropdown-menu">
                <li><a id="piano_drop" class="dropdown-item user-select-none active" onclick="change_instrument('piano')">Piano</a></li>
                <li><a id="steel_guitar_drop" class="dropdown-item user-select-none" onclick="change_instrument('steel_guitar')">Steel Guitar</a></li>
                <li><a id="nylon_guitar_drop" class="dropdown-item user-select-none" onclick="change_instrument('nylon_guitar')">Nylon Guitar</a></li>
                <li><a id="dual_synth_drop" class="dropdown-item user-select-none" onclick="change_instrument('dual_synth')">Dual Synth</a></li>
                <li><a id="fm_synth_drop" class="dropdown-item user-select-none" onclick="change_instrument('fm_synth')">FM Synth</a></li>
                <li><a id="am_synth_drop" class="dropdown-item user-select-none" onclick="change_instrument('am_synth')">AM Synth</a></li>
                <li><a id="test_synth_drop" class="dropdown-item user-select-none" onclick="change_instrument('test_synth')">Test Synth</a></li>
            </ul>
        </div>
        <div class="input-group pe-2" role="group">
            <span class="input-group-text user-select-none" id="addon-wrapping">BPM</span>
            <button onclick="change_bpm_by(-1)" type="button" class="btn btn-light">-</button>
            <input type="text" class="form-control" id="bpm" aria-label="BPM" value="120" oninput="change_bpm_by(0)"/>
            <button onclick="change_bpm_by(1)" type="button" class="btn btn-light">+</button>
        </div>
        <div class="input-group pe-2">
            <span class="input-group-text user-select-none" id="addon-wrapping"><?= Yii::t('app', 'Volume') ?></span>
            <input type="range" min="0" max="100" value="60" class="form-control" id="volume_slider" oninput="update_volume()">
            <span class="input-group-text user-select-none" id="volume_text">60</span>
        </div>
        <div class="btn-group ms-auto" id="save_delete_buttons" role="group">
            <button onclick="openPopup('erase_popup')" class="btn btn-danger"><?= Yii::t('app', 'Clear') ?></button>
            <button onclick="openPopup('save_popup')" type="button" class="btn btn-success"><?= Yii::t('app', 'Save Chime') ?></button>
        </div>
    </div>
</div>

<!-- save chime popup -->
<div id="save_popup">
    <div class="overlay_opaque" onclick="closePopup('save_popup')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'Save Chime') ?></h1>
        <?php $form = ActiveForm::begin(['id' => 'form-savechime', 'layout' => 'floating']); ?>

        <?= $form->errorSummary($model);?>

        <?= $form->field($model, 'title')->label(Yii::t('app', 'Give the chime a title!')) ?>
        <?= $form->field($model, 'public')->checkbox(['uncheck' => '0', 'value' => '1']); ?>
        <?= $form->field($model, 'user_id')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'instrument')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'bpm')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'content')->hiddenInput()->label(false); ?>

        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <button onclick="closePopup('save_popup')" type="button" class="btn btn-danger"><?= Yii::t('app', 'Close') ?></button>
                </div>
                <div class="col">
                    <input type="reset" onclick="reset_char_left()" value="Reset" class="btn btn-warning">
                </div>
                <div class="col">
                    <input type="submit" value="Save" class="btn btn-success">
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<!-- erase chime popup -->
<div id="erase_popup">
    <div class="overlay_opaque" onclick="closePopup('erase_popup')"></div>
    <div class="popup">
        <h1 class="page_title"><?= Yii::t('app', 'Erase board') ?></h1>
        <h3 class="page_title">
            <p><?= Yii::t('app', 'This will clear the entire board!') ?></p>
            <p><?= Yii::t('app', 'Are you sure you want to continue?') ?></p>
        </h3>
        <br>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <button onclick="closePopup('erase_popup')" type="button" class="btn btn-danger"><?= Yii::t('app', 'No') ?></button>
                </div>
                <div class="col">
                    <button onclick="erase_table()" type="button" class="btn btn-success"><?= Yii::t('app', 'Yes') ?></button>
                </div>
            </div>
        </div>
    </div>
</div>