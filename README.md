<p align="center">
    <!--<img src="https://photos.app.goo.gl/usoDHrByVaEMfTXG8" height="100px"> -->
    <h1 align="center">ChimeShare</h1>
</p>

<h3 align="center">ChimeShare is an online web project dedicated to making music accesible to everyone, with a social twist. </h3>
<br>

We all know those ideas that come randomly during the day that seem glorious, but that we can't seem to be able to save in time. With this website, sharing and writing your own short melodies becomes easier than ever.
All the basic needs for making simple melodies are brought here, on the same platform, to eliminate the stress of not being able to find a comfortable workflow for your music creation.

This platform enables the making of short melodies, of 32 notes of length, covering 2 octaves.

<h2>The social aspect</h2>

This project is also made with the social aspect of it in mind. The front page is designed specifically to allow the discovery of the newest and most popular chimes made by other users. With this in mind, we've made a way for people to 
connect to eachother by allowing the creation of accounts on the website. This also enables the possibility of following your favourite creators on the platform.

Each chime you make has the option to be shown to the public, where it can gather likes by other users, bringing the possibility of becoming the next big chime-maker!

<h2>A short history</h2>

Right now the project is based on the [Yii](https://www.yiiframework.com/) PHP framework and the [Tone.js](https://tonejs.github.io/) library, for sounds.

----------------

This website was originally written only in HTML, CSS, JavaScript and a bit of PHP, but as time went on and new features were added, I realized this was not going to be enough.

The next logical step was to port the project to a PHP micro-framework, [Limonade](http://limonade-php.github.io/), that took care of the routing and views of the site. With this change made, I also took the
time to upgrade the sound-part of the project. Before, each sound was an mp3 file being played, which meant I needed to make an mp3 file for every one of the 24 notes, for every instrument that I planned to add.
You can imagine that this was very tedious, and it wasn't even perfoming great. 

The new implementation was based around [audiosynth](https://github.com/keithwhor/audiosynth), by Keithwhor, but I soon found out
that this also wasn't able to playmultiple notes simultaneously. The fact that JavaScript is a single-threaded language, made the implementation of polyphony very hard to achieve by myself, so I knew that finding a new library was a must.

Here's when [Tone.js](https://tonejs.github.io/) comes into play. This library takes care of the note polyphony situation, and is also able to generate instrument sounds on the go. This means that the sounds are made based on
different variables that I can change easily, without needing to redo any files myself. This also means that, in the future, I can add a feature that lets users make their own instruments, or sample different sound of their own.

For this change to be possible, I rerwrote, for the third time, the entire backend for the <b>Chime Maker</b> page, changing the way the notes are stored in the background on the user machine, and later on the data-base.
With this new structure design, I am also able to store different lenghts for notes, enabling endless posibilities! (theoretically 2 to the power of 3072, but who's counting :] It's still a lot )

<h2>Documentation and technologies</h2>

More information about the technologies used can be found on the [documentation](documentation.md).
