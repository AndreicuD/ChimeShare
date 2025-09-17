<h1 align="center">WARNING, old project not mantained anymore! </h1>

<img width="2560" height="1327" alt="image" src="https://github.com/user-attachments/assets/5c9ec4f7-6138-4e66-9f8a-4c84f8a3b5f9" />
<img width="2560" height="1327" alt="image" src="https://github.com/user-attachments/assets/f1e9043c-8fa2-4507-9838-119b4f84a65e" />

<p align="center">
    <a href="https://chime-share.com" target="_blank">
        <img src="https://chime-share.flexi-design.ro/frontend/web/img/logo-orig.png" height="100px">
    </a>
    <h1 align="center">Chime Share</h1>
    <br>
</p>

Proiect realizat sub îndrumarea:
* Prof. Carmen Nicoleta Mincă
* Prof. Simona Ionescu
* Prof. Magdalena Rădulescu

<h2 align="center">RO 🇷🇴</h2>
<h3 align="center">ChimeShare este un proiect web online care încearcă să facă muzica accesibilă pentru toată lumea, cu un twist social.</h3>
<br>

<p>Cu toții cunoaștem acele idei care apar aleatoriu în timpul zilei și care par incredibile, dar pe care nu reușim să le salvăm la timp. Cu acest site,
împărtășirea și scrierea propriilor tale melodii scurte devine mai ușoară ca niciodată. Toate necesitățile de bază pentru crearea de melodii simple sunt
aduse aici, pe aceeași platformă, pentru a elimina stresul de a nu putea găsi un workflow confortabil pentru crearea muzicii tale.</p>
    
<p>Această platformă permite crearea de melodii scurte, de 32 de note lungime, acoperind 2 octave.</p>
    
<h2>Aspectul social</h2>
    
<p>Acest proiect este realizat luând în considerare și aspectul social al acestuia. Pagina principală este concepută special pentru a permite descoperirea celor mai noi și populare 
melodii create de alți utilizatori. Având acest lucru în vedere, am creat o modalitate prin care oamenii să se conecteze între ei, permițând crearea de conturi pe site.
<!--Acest lucru ne oferă, de asemenea, posibilitatea de a urmări creatorii preferați pe platformă.--></p>

<p>Fiecare melodie creată are opțiunea de a fi afișată publicului, unde poate aduna aprecieri de la alți utilizatori, oferind posibilitatea de a deveni următorul
„Chime-Maker”!</p>

<h2>O scurtă istorie</h2>

<p id="aici">În prezent, proiectul este bazat pe framework-ul PHP <a href="https://www.yiiframework.com/" target="_blank">Yii</a> și
biblioteca <a href="https://tonejs.github.io/" target="_blank">Tone.js</a> pentru sunete.</p>    

<p>Acest site a fost scris inițial doar în HTML, CSS, JavaScript și puțin PHP, dar pe măsură ce timpul a trecut și au fost
adăugate funcții noi, am realizat că acestea nu vor fi suficiente.</p>

<p>Pasul logic următor a fost portarea proiectului pe un micro-framework PHP, <a href="http://limonade-php.github.io/" target="_blank">Limonade</a>, care
se ocupa de rutare și view-urile site-ului. Odată cu această schimbare, am profitat de ocazie pentru a îmbunătăți partea de sunet a proiectului. Înainte,
fiecare sunet era un fișier mp3 care era redat, ceea ce însemna că trebuia să creez un fișier mp3 pentru fiecare dintre cele 24 de note, pentru fiecare
instrument pe care intenționam să îl adaug. Vă puteți imagina că acest lucru era foarte plictisitor și nici nu avea o performanță grozavă.</p>

<p>Noua implementare se baza pe <a href="https://github.com/keithwhor/audiosynth" target="_blank">audiosynth</a>, de Keithwhor, dar am descoperit curând
că nici aceasta nu putea reda multiple note simultan. Faptul că JavaScript este un limbaj single-threaded a făcut ca implementarea
polifoniei să fie foarte dificil de realizat de unul singur, așa că am știut că găsirea unei noi biblioteci era necesară.</p>

<p>Aici intervine <a href="https://tonejs.github.io/" target="_blank">Tone.js</a>. Această bibliotecă rezolvă problema polifoniei notelor
și poate, de asemenea, să genereze sunete de instrumente pe loc. Acest lucru înseamnă că sunetele sunt create pe baza diferitelor variabile pe care le pot schimba ușor,
fără a fi nevoie să refac vreun fișier eu însumi. Astfel, în viitor pot fii adăugate funcții care permit utilizatorilor să-și creeze propriile
instrumente sau să facă sample-uri la diferite sunete de-ale lor.</p>

<p>Pentru ca această schimbare să fie posibilă, am rescris, pentru a treia oară, întregul backend pentru pagina <b>Chime Maker</b>, schimbând modul în care notele sunt
stocate în fundal pe mașina utilizatorului și ulterior în baza de date. Cu acest nou design de structură pot astfel stoca note de diferite lungimi,
permițând posibilități nelimitate! (teoretic 2 la puterea 3072, dar cine stă să numere? 😎 )</p>

<p>Odată cu trecerea la Tone.js, am decis să portez proiectul și pe un framework mai puternic, <a href="https://www.yiiframework.com/" target="_blank">Yii</a>. Yii aduce foarte multe îmbunătățiri atât la partea de securitate,
cât și pe alte planuri, lucru care a permis dezvoltarea proiectului în direcția dorită, dar 
implementarea lui a însemnat o rescriere a întregului site și a modului în care funcționează. Pe parcursul acestui proiect, am învațat foarte multe lucruri noi.</p>

<h2>Documentație și tehnologii</h2>

<p>Mai multe informații despre tehnologiile utilizate pot fi găsite în 
<a href="https://github.com/AndreicuD/ChimeShare/blob/main/docs/ChimeShare-2.pdf" target="_blank">documentație</a>.</p>

------------------------------

<h2 align="center">EN 🇬🇧</h2>
<h3 align="center">ChimeShare is an online web project dedicated to making music accesible to everyone, with a social twist. </h3>
<br>

<p>We all know those ideas that come randomly during the day that seem glorious, but that we can't seem to be able to save in time. With this website, sharing and writing
your own short melodies becomes easier than ever. All the basic needs for making simple melodies are brought here, on the same platform, to eliminate the stress of not 
being able to find a comfortable workflow for your music creation. </p>

<p>This platform enables the making of short melodies, of 32 notes of length, covering 2 octaves.</p>

<h2>The social aspect</h2>

<p>This project is also made with the social aspect of it in mind. The front page is designed specifically to allow the discovery of the newest and most popular 
chimes made by other users. With this in mind, we've made a way for people to connect to eachother by allowing the creation of accounts on the website. 
<!--This also enables the possibility of following your favourite creators on the platform.--></p>

<p>Each chime you make has the option to be shown to the public, where it can gather likes by other users, bringing the possibility of becoming the next big chime-maker!</p>

<h2>A short history</h2>

<p>Right now the project is based on the <a href="https://www.yiiframework.com/" target="_blank">Yii</a> PHP framework and
the <a href="https://tonejs.github.io/" target="_blank">Tone.js</a> library for sounds.</p>    

<p>This website was originally written only in HTML, CSS, JavaScript and a bit of PHP, since that was what I knew, but as time went on and new features were added,
I realized this was not going to be enough.</p>

<p>The next logical step was to port the project to a PHP micro-framework, <a href="http://limonade-php.github.io/" target="_blank">Limonade</a>, that took care
of the routing and views of the site. With this change made, I also took the time to upgrade the sound-part of the project. Before, each sound was an mp3 file
being played, which meant I needed to make an mp3 file for every one of the 24 notes, for every instrument that I planned to add. You can imagine that this
was very tedious, and it wasn't even perfoming great.</p>

<p>The new implementation was based around <a href="https://github.com/keithwhor/audiosynth" target="_blank">audiosynth</a>, by Keithwhor, but I soon found out
that this also wasn't able to play multiple notes simultaneously. The fact that JavaScript is a single-threaded language made the implementation
of polyphony very hard to achieve by myself, so I knew that finding a new library was a must. </p>

<p>Here's when <a href="https://tonejs.github.io/" target="_blank">Tone.js</a> comes into play. This library takes care of the note polyphony situation,
and is also able to generate instrument sounds on the go. This means that the sounds are made based on different variables that I can change easily,
without needing to redo any files myself. This also means that, in the future, I can add features that let users make their own instruments, or sample
different sound of their own.</p>

<p>For this change to be possible, I rewrote, for the third time, the entire backend for the <b>Chime Maker</b> website, changing the way the notes are
stored in the background on the user machine, and later on the data-base. With this new structure design, I am also able to store different lenghts for
notes, enabling endless posibilities! (theoretically 2 to the power of 3072, but who's counting? 😎 )</p>

<p>While changing my sound-engine to Tone.js, I also opted to port my project to a bigger framework, Yii, that took care of security for me. This meant that the entire
project needed to be rewriten to fit this new model I went with. I learned a lot while doing this project, and I realized there are still a
lot of things I need to learn. </p>

<h2>Documentation and technologies</h2>

<p>More information about the technologies used can be found on 
the <a href="https://github.com/AndreicuD/ChimeShare/blob/main/docs/ChimeShare-2.pdf" target="_blank">documentation</a>.</p>
