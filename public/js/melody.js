const note_array = new Map([
    ["24", "C4"],
    ["23", "C#4"],
    ["22", "D4"],
    ["21", "D#4"],
    ["20", "E4"],
    ["19", "F4"],
    ["18", "F#4"],
    ["17", "G4"],
    ["16", "G#4"],
    ["15", "A4"],
    ["14", "A#4"],
    ["13", "B4"],
    
    ["12", "C5"],
    ["11", "C#5"],
    ["10", "D5"],
    ["9", "D#5"],
    ["8", "E5"],
    ["7", "F5"],
    ["6", "F#5"],
    ["5", "G5"],
    ["4", "G#5"],
    ["3", "A5"],
    ["2", "A#5"],
    ["1", "B5"],
]);
const note_durations = new Map ([
	[0, '0'],
	[0.25, '8n'],
	[0.5, '4n'],
	[0.75, '2n'],
	[1, '1n']
]);

const melody = [];

//-----------------------------------------------------------------------------------

const synth = new Tone.Synth().toDestination();
const now = Tone.now();

function playNote(instrument, note, duration) {
	//const audio = new Audio();
	//console.log('./sounds/' + instrument + '/' + note);
	//audio.src = './sounds/' + instrument + '/' + note;
	
	//audio.play();
	//create a synth and connect it to the main output (your speakers)
	const synth = new Tone.AMSynth().toDestination();
	//synth.triggerAttackRelease(note, note_durations.get(duration));
	synth.triggerAttackRelease(note_array.get('' + note), note_durations.get(duration));
}

//-----------------------------------------------------------------------------------

var instrument='piano';
var volume = 1;

function change_instrument(instr_name) {
	var temp = document.getElementById(instrument+'_drop');
	if(temp.className.includes('active')) {
		temp.className = temp.className.replace('active', '');
	}
	temp = document.getElementById(instr_name+'_drop');
	temp.className += 'active';
    instrument = instr_name;
}

function check_cell(cell_pressed) {
	//split the input string "cXrY", where X and Y are numbers, into two different variables;
	//basically extracting the numbers
	cell_id = cell_pressed.id;
	var c_split = cell_id.split('c');
	var r_split = c_split[1].split('r');
	col=r_split[0];
	row=r_split[1];
	col = parseInt(col);
	row = parseInt(row);

	//console.dir(cell_id+' - '+raw_duration);
	
	//first we verify that it's not part of the piano on the left of the page (where col==0)
	if(col!=0) {
		//then we get the duration of that note
		var raw_duration = parseInt(cell_pressed.dataset.duration);
		if (raw_duration < 4) {
			raw_duration += 1;
			cell_pressed.innerText = raw_duration+'/4';
			duration = raw_duration/4;
		} else {
			raw_duration = 0;
			cell_pressed.innerText = '';
		}
		cell_pressed.dataset.duration = raw_duration;

		//now we give it the class that makes the button blue if it doesn't have it
		if(raw_duration > 0) {
			if (!cell_pressed.className.includes("active_cell")) {
				cell_pressed.className += " active_cell";
			}		
		} else {
			cell_pressed.className = cell_pressed.className.replace(' active_cell','');
		}

		//and we re-make the melody array
		melody.length = 0;
		for(var i=1; i<=32; i++) {
			var current_column_notes = []
			for(var j=1; j<=24; j++) {
				var current_index = 'c' + i + 'r' + j;
				var current_cell = document.getElementById(current_index);
				if (current_cell.dataset.duration != 0) {
					current_column_notes.push(current_index);
				}
			}
			if (current_column_notes.length != 0) {
				melody.push(current_column_notes);
			}
		}
		console.log(melody);
	}

	//play note
	playNote(instrument, row, 0.25);
}

function erase_table() {
	for(var i=1; i<=24; i++) {
		for(var j=1; j<=32; j++) {
			var temp = document.getElementById('c' + j + 'r' + i);
			temp.className = temp.className.replace(' active_cell','');
			temp.dataset.duration = 0;
			temp.innerText = '';
		}
	}
	melody.length = 0;
	closePopup('erase_popup');
}

//-----------------------------------------------------------------------------------

var timer;
var melody_playing = false;
var playback_pointer = 2;
var melody_pointer = 0;
var bpm = 120;
var time_sign = 4; // aka 4/4

function add_played_col_class_to(col) {
	for(var j=1; j<=24; j++) {
		var id = 'c' + col + 'r' + j;
		var note = document.getElementById(id);
		note.className += ' played_col';
	}
}
function remove_played_col_class_to(col) {
	for(var j=1; j<=24; j++) {
		var id = 'c' + (col-1) + 'r' + j;
		var note = document.getElementById(id);
		note.className = note.className.replace(' played_col','');
	}
}
function check_and_play_col(playback_pointer) {
	var current_cell_id = melody[melody_pointer][0];
	var check_cell_column_split = current_cell_id.split('c');
	var check_cell_row_split = check_cell_column_split[1].split('r');
	var check_cell_col = check_cell_row_split[0];
	check_cell_col = parseInt(check_cell_col);

	if(check_cell_col == playback_pointer) {
		for(let note in melody[melody_pointer]) {

			var cell_id = melody[melody_pointer][note];
			var c_split = cell_id.split('c');
			var r_split = c_split[1].split('r');
			col=r_split[0];
			row=r_split[1];
			col = parseInt(col);
			row = parseInt(row);
			playNote(instrument, row, document.getElementById(melody[melody_pointer][note]).dataset.duration / 4)
		}
		if( (melody_pointer+1) != melody.length ) {
			melody_pointer++;
		}
	}
}

function playMelody() {
	var play_button = document.getElementById('play_button');

	var note_speed = 1000 * 60 / (bpm * time_sign);
	if (!melody_playing) {
		play_button.innerHTML = '&#x23F9;';
		melody_playing = true;
		playback_pointer = 2;
		melody_pointer = 0;
	
		add_played_col_class_to(1);
		check_and_play_col(1);
		remove_played_col_class_to(1);
		timer = setInterval(play_notes, note_speed);
	} else {
		play_button.innerHTML = '&#x25B6;';
		remove_played_col_class_to(playback_pointer);
		clearInterval(timer);
		playback_pointer = 1;
		melody_playing = false;
		//timer = setInterval(play_notes, note_speed);
	}

	function play_notes() {
		if (playback_pointer == 33) {
				remove_played_col_class_to(33);
				playback_pointer=2;
				melody_pointer = 0;
				clearInterval(timer);
				melody_playing = false;
				play_button.innerHTML = '&#x25B6;';
			} else {
				add_played_col_class_to(playback_pointer);
				check_and_play_col(playback_pointer);
				remove_played_col_class_to(playback_pointer);
			}
			playback_pointer++;
		}
}

//-----------------------------------------------------------------------------------

function change_bpm_by(i) {
	document.getElementById("bpm").value = parseInt(document.getElementById("bpm").value) + i;
	bpm = document.getElementById("bpm").value;
	Tone.bpm = bpm;
}

function update_volume() {
	volume = parseInt( document.getElementById('volume_slider').value );
	document.getElementById('volume_text').innerText = volume;
	volume = volume/100;
	Tone.bpm = bpm;
}

//-----------------------------------------------------------------------------------

function sendMelodyData() {
	var name_form;
	var description_form;
	var jsonMap;
	
	jsonMap = JSON.stringify([...melody.entries()]);
	name_form = document.getElementById('melody_name').value;
	description_form = document.getElementById('melody_description').value;

	var jsonBase = "[[1,[]],[2,[]],[3,[]],[4,[]],[5,[]],[6,[]],[7,[]],[8,[]],[9,[]],[10,[]],[11,[]],[12,[]],[13,[]],[14,[]],[15,[]],[16,[]],[17,[]],[18,[]],[19,[]],[20,[]],[21,[]],[22,[]],[23,[]],[24,[]],[25,[]],[26,[]],[27,[]],[28,[]],[29,[]],[30,[]],[31,[]],[32,[]]]";

	if (name_form != '' && jsonMap!=jsonBase) {
		var melody_information = {title: name_form, description: description_form, data: jsonMap};
		melody_information = JSON.stringify(melody_information);
		
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "melody_process.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && xhr.status == 200) {
						//window.location.href = 'melody_process.php';
						closePopup("save_popup");
						//console.log(xhr.responseText);
				}
		};

		// Send the JSON data as a POST parameter
		xhr.send("jsonData=" + encodeURIComponent(melody_information));
	} else {
		if(name_form=='') {
			var temp = document.getElementById('melody_name');
			temp.className += " is-invalid"
		}
	}
}

//-----------------------------------------------------------------------------------

function openPopup(id) {
	var container = document.querySelector('#'+id);
	var popup = container.querySelector('.popup');
	var overlay = container.querySelector('.overlay_opaque');
	popup.style.display = 'block';
	overlay.style.display = 'block';
}

function closePopup(id) {
	var container = document.querySelector('#'+id);
	var popup = container.querySelector('.popup');
	var overlay = container.querySelector('.overlay_opaque');
	popup.style.display = 'none';
	overlay.style.display = 'none';
}

//-----------------------------------------------------------------------------------

function changeCharLeft(input_form, char_left, maxsize) {
    var chars = document.getElementById(char_left+'');
    
    var input = document.getElementById(input_form+'');
    if(input.className.includes('is-invalid')) {
        input.className = input.className.replace(' is-invalid','');
    }

    var inputVal = document.getElementById(input_form+'').value;
    chars.innerText = maxsize-inputVal.length;
}

function reset_char_left() {
    document.getElementById('char_left_title').innerText = 255;
    document.getElementById('char_left_desc').innerText = 1000;
}

//-----------------------------------------------------------------------------------

function initialize_site() {
	Tone.start();
	update_volume();
	change_bpm_by(0);
}

window.onload = initialize_site;