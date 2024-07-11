let play_button = null;
function play_item_melody(public_id, melody_instrument, melody_bpm) {
    playback_pointer = 1;
    chime_pointer = 0;
    play_buttons = document.getElementsByClassName("play_btn");
    for(btn in play_buttons) {
        play_buttons[btn].innerHTML =  '&#x25B6;';
    }
    if(timer) {
        clearInterval(timer);
    }
	chime = JSON.parse(document.getElementById('public-id-' + public_id).innerText);
	play_button = document.getElementById('play-button-' + public_id);
    instrument = melody_instrument;
    bpm = melody_bpm;
    Tone.Transport.bpm.value = bpm;

	var note_speed = 1000 * 60 / (bpm * 4);
	if (!chime_playing) {
		play_button.innerHTML = '&#x23F9;';
		chime_playing = true;
		playback_pointer = 1;
        chime_pointer = 0;

		timer = setInterval(play_col_notes_index, note_speed);
	} else {
		play_button.innerHTML = '&#x25B6;';
		clearInterval(timer);
		chime_playing = false;
		playback_pointer = 1;
        chime_pointer = 0;
	}
}

function play_col_notes_index() {
    if (playback_pointer == 33) {
        chime_playing = false;
        playback_pointer = 1;
        chime_pointer = 0;
        clearInterval(timer);
        play_button.innerHTML = '&#x25B6;';
    } else {
        check_and_play_col_index(playback_pointer);
    }
    playback_pointer++;
}

function check_and_play_col_index(playback_pointer) {
	var current_cell_id = chime[chime_pointer][0].id;
	var check_cell_column_split = current_cell_id.split('c');
	var check_cell_row_split = check_cell_column_split[1].split('r');
	var check_cell_col = check_cell_row_split[0];
	check_cell_col = parseInt(check_cell_col);

	if(check_cell_col == playback_pointer) {
		for(let note in chime[chime_pointer]) {
			//console.log(note);
			var cell_id = chime[chime_pointer][note].id;
			var c_split = cell_id.split('c');
			var r_split = c_split[1].split('r');
			col=r_split[0];
			row=r_split[1];
			col = parseInt(col);
			row = parseInt(row);
			playNote(instrument, row, chime[chime_pointer][note].duration / 4)
		}
		if( (chime_pointer+1) != chime.length ) {
			chime_pointer++;
		}
	}
}