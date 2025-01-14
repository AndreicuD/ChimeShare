<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Chime';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('/js/melodyMaker.js', ['depends' => [\yii\web\JqueryAsset::class]]);

// the number or columns in the grid
$cols=32;

// the number of rows in the grid
$rows=24;

// the positions for the black piano keys
$black_keys = array("2", "4", "6", "9", "11", "14", "16", "18", "21", "23");

$button_classes= "";
?>

<h1 class="page_title">Melody maker</h1>

<div id="music_interface" class="container mt-3">
    <?php for($i=1; $i<=$rows; $i++) { ?>
        <div class="row justify-content-center">
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
    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Bottom toolbar">
        <div class="btn-group me-auto" role="group">
                <button class="play_btn" id="play_button" onclick="playMelody()">&#x25B6;</button>
        </div>
        <div class="input-group pe-2">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Instrument
            </button>
            <ul class="dropdown-menu">
                <li><a id="piano_drop" class="dropdown-item active user-select-none" onclick="change_instrument('piano')">Piano</a></li>
                <li><a id="organ_drop" class="dropdown-item user-select-none" onclick="change_instrument('organ')">Organ</a></li>
                <li><a id="acoustic_drop" class="dropdown-item user-select-none" onclick="change_instrument('acoustic')">Acoustic</a></li>
                <li><a id="edm_drop" class="dropdown-item user-select-none" onclick="change_instrument('edm')">Edm</a></li>
            </ul>
        </div>
        <div class="input-group pe-2" role="group">
            <span class="input-group-text user-select-none" id="addon-wrapping">BPM</span>
            <button onclick="change_bpm_by(-1)" type="button" class="btn btn-outline-secondary">-</button>
            <input type="text" class="form-control" id="bpm" aria-label="BPM" value="120" oninput="change_bpm_by(0)"/>
            <button onclick="change_bpm_by(1)" type="button" class="btn btn-outline-secondary">+</button>
        </div>
        <div class="input-group form-range">
            <span class="input-group-text user-select-none" id="addon-wrapping">Volume</span>
            <input type="range" min="0" max="100" value="100" class="form-control" id="volume_slider" oninput="update_volume()">
            <span class="input-group-text volume_text user-select-none" id="volume_text">100</span>
        </div>
        <div class="btn-group ms-auto" role="group">
            <button onclick="openPopup('erase_popup')" class="btn btn-danger">Erase</button>
            <button onclick="openPopup('save_popup')" type="button" class="btn btn-success"> Save Melody </button>
        </div>
    </div>
</div>

	<!-- save melody popup -->
	<div id="save_popup">
		<div class="overlay_opaque"></div>
		<div class="popup">
			<h1 class="page_title">Save Melody</h1>
			<form class="mb-3" id="myForm" method="post" action="melody_process.php">
				<label for="melody_name">Give the melody a name!</label>
				<input type="text" maxlength="255" oninput="changeCharLeft('melody_name', 'char_left_title', 255)" class="form-control" id="melody_name" placeholder="Your melodies name here!" name="melody_name">
				<p class="small_gray_text" id="char_left_title">255</p>

				<label for="melody_description" class="form-label">Melody Description</label>
				<textarea maxlength="1000" oninput="changeCharLeft('melody_description', 'char_left_desc', 1000)" class="form-control" id="melody_description" rows="3" name="melody_description"></textarea>
				<p class="small_gray_text" id="char_left_desc">1000</p>
				<br>
				<div class="container text-center">
					<div class="row">
						<div class="col">
							<button onclick="closePopup('save_popup')" type="button" class="btn btn-danger">Close</button>
						</div>
						<div class="col">
							<input type="reset" onclick="reset_char_left()" value="Reset" class="btn btn-warning"></input>
						</div>
						<div class="col">
							<input type="button" onclick="sendMelodyData()" value="Submit" class="btn btn-success"></input>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- erase melody popup -->
	<div id="erase_popup">
			<div class="overlay_opaque"></div>
			<div class="popup">
				<h1 class="page_title">Erase Melody</h1>
				<h2 class="page_title">
					This will clear the entire board!
					<br>
					Are you sure you want to continue?
				</h2>
				<br>
				<div class="container text-center">
					<div class="row">
						<div class="col">
							<button onclick="closePopup('erase_popup')" type="button" class="btn btn-danger">No</button>
						</div>
						<div class="col">
							<button onclick="erase_table()" type="button" class="btn btn-success">Yes</button>
						</div>
					</div>
				</div>
			</div>
    </div>
