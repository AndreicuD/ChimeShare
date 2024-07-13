<p align="center">
    <a href="https://chime-share.com" target="_blank">
        <img src="https://chime-share.com/frontend/web/img/logo-white.png" height="100px">
    </a>
    <h1 align="center">ChimeShare Documentation</h1>
    <br>
</p>

<h1>RO</h1>

Acest proiect este bazat pe frameworkul de PHP [Yii](https://www.yiiframework.com/) și pe librăria [Tone.js](https://tonejs.github.io/), utilizată pentru a genera sunetul instrumentelor.

## Tehnologii utilizate:

### Externe:

- [Yii 2](https://www.yiiframework.com/) - framework open-source MVC pentru PHP care se ocupă de rutare, viewuri, administrare de asset-uri, modele de date, autentificare, autorizare și alte elemente de securitate care previn atacurile nedorite.
- [Tone.js](https://tonejs.github.io/) - librărie open-source de JavaScript care generează sunetele diferitelor instrumente pe loc, în funcție de anumiți parametri setați în cod.
- [Bootstrap 5](https://getbootstrap.com/) - librărie open-source CSS și JavaScript folosită pentru construirea interfeței grafice într-un mod standardizat și responsive.
  
### Frontend
- HTML
- CSS
- JavaScript

### Backend
- PHP 8
- MariaDB 11
  
### Diverse:

- Github

## Cerințe de sistem:

- Conexiune la internet
- Un browser relativ modern

### Pentru rularea locală a proiectului este nevoie de:

- PHP 8
- Composer
- Server Apache
- MariaDB


## Paginile și structura site-ului:

### Designul:

-------------------------------

Designul este unul simplu, modern și minimalist, creat atât din clase utilitare, cât și cu ajutorul claselor oferite de Bootstrap.

Am avut grijă ca aplicația să se adapteze corect atât unui ecran cu lațime mare (desktop/laptop), cât și pe un ecran de mărime medie (ca o tabletă). Pentru ecranele mai mici, asemenea
celor găsite pe telefoane, interfața se adapteaza și reușește să își păstreze în mare parte aceleași capabilități.

![a photo of the navbar, as it appears on a desktop](https://github.com/AndreicuD/ChimeShare/assets/78648231/1d6b59f0-32d7-40bd-ab51-f16e85a3f3fb)
![a photo of the navbar, as it appears on a phone](https://github.com/AndreicuD/ChimeShare/assets/78648231/2964da67-4fca-486e-a827-9a13f6fd230b)

### Structura:

-------------------------------

Structura pentru un utilizator fără cont (guest) este un simplă, asemenea majorității site-urilor de pe internet.

![a photo of the navbar, for a guest user](https://github.com/AndreicuD/ChimeShare/assets/78648231/7a591fdf-f832-44f1-a2c7-7a467ff5eda6)


Utilizatorul are acces la prima pagină, de unde poate asculta ultimele melodii urcate sau melodiile cele mai apreciate de comunitate, dar și la paginile 'About' și 'Contact'.

![a photo of the contact form](https://github.com/AndreicuD/ChimeShare/assets/78648231/52a12c4d-8b2e-45d3-add9-6492d813b666)

După ce utilizatorul își face cont, el primește dreptul de a:

1. Aprecia melodiile altui utilizator
2. Crea propriile melodii

Așa arată noua lui bară de navigație:

![a photo of the new navbar, after the user logins](https://github.com/AndreicuD/ChimeShare/assets/78648231/d1777afd-24cd-4cb7-bc40-0c6b6964f073)

Pentru a își crea propria melodie utilizatorul trebuie să ajungă la pagina 'My Chimes': 

![a photo of the page My Chimes](https://github.com/AndreicuD/ChimeShare/assets/78648231/59101182-bfd5-4984-b39e-560755e6b578)

Aici va apăsa butonul 'Make a New Chime!', care îl va duce pe această pagină:

![A website page that allows you to make your own melodies](https://github.com/AndreicuD/ChimeShare/assets/78648231/ebdbc2da-4c35-47df-90ae-4cba734c7b86)


Aici utilizatorul poate crea propriile melodii, el putând să le asculte ulterior la diferite instrumente și tempo-uri, în funcție de preferințe.

El poate alege de asemenea să salveze melodia după terminarea acesteia, moment în care are de completat un formular.

Utilizatorul este liber să aleagă dacă își dorește ca melodia lui să fie publică, moment în care apare și pe prima pagină, la secțiunea 'Latest Chimes', sau să o păstreze privată.


### Cum funcționeaza în fundal:

-------------------------------

Gridul în care utilizatorul își face muzica este de fapt generat pe loc cu ajutorul PHP-ului, în funcție de anumite variabile decise de mine (lucru care îmi permite pe viitor să
extind tot proiectul, sau poate chiar să îl fac compatibil cu mai multe instrumente în același timp). Fiecăruia din aceste butoane îi este dat un id unic, care urmează regula:
"c_r_", unde 'c' vine de la 'column/coloană', iar 'r' de la 'row/rând'. Fiecare buton are de asemeanea o legătură 'onclick' la o funcție JavaScript care „sparge” id-ul (dupa „C„ si respectiv „R”) 
pentru a recunoaște exact ce notă are nevoie să cânte (în funcție de rândul în care se află), iar care mai apoi generează un obiect care ține toate informațiile melodiei, a
notelor cântate. Astfel, acest obiect poate fi foarte usor salvat sub forma <b>JSON</b>, pentru a fi salvat eficient într-o baza de date.

Fiecărei melodii îi este atribuită pe lângă lucrurile de bază (nume și autor) și un id public, diferit față de cel din baza de date. Acest lucru permite
deschiderea pentru ascultarea melodiilor altor persoane pe baza unui simplu link, care poate fi distribuit ușor și care va conține acel id public in structura lui.
Ex: [https://chime-share.com/chime/listen?id=548fd187-1945-11ef-b1cc-309c233d53c1](https://chime-share.com/chime/listen?id=548fd187-1945-11ef-b1cc-309c233d53c1)

În plus, fiecare melodie publică are de asemenea și un contor de like-uri, lucru care permite formarea acelei liste cu cele mai bune melodii pe care o găsim pe prima pagină
și care aduce elemente asemănătoare unui 'social media' pe platformă.

### Planuri de viitor:

-------------------------------

îmi doresc să aduc pe platformă cât mai multe elemente sociale în viitor. Vreau, de exemplu, să poți deschide pagina unui alt utilizator ca să explorezi toate melodiile lui
publice, să poți să îl urmărești pe platformă, astfel arătându-ți aprecierea. Structura proiectului în prezent permite dezvoltarea acestor funcții
cu ușurință, astfel că lista de melodii a unui utilizator este strâns legată de acesta și poate fi astfel extrasă din baza de date cu foarte puține interogări, fiind totul
foarte rapid.
