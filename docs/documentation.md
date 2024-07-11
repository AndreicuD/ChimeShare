<p align="center">
    <a href="https://chime-share.com" target="_blank">
        <img src="https://chime-share.com/frontend/web/img/logo-white.png" height="100px">
    </a>
    <h1 align="center">ChimeShare Documentation</h1>
    <br>
</p>

<h1>RO</h1>

Acest proiect este bazat pe frameworkul de PHP [Yii](https://www.yiiframework.com/) si pe libraria [Tone.js](https://tonejs.github.io/), utilizata pentru a genera sunetul instrumentelor.

## Tehnologii utilizate:

### Externe:

- [Yii 2](https://www.yiiframework.com/) - framework open-source MVC pentru PHP care se ocupa de rutare, viewuri, administrare de asset-uri, modele de date, autentificare, autorizare si alte elemente de securitate care previn atacurile nedorite.
- [Tone.js](https://tonejs.github.io/) - librarie open-source de JavaScript care genereaza sunetele diferitelor instrumente pe loc, in functie de anumiti parametri setati in cod. Va permite si user-ului sa isi creeze propriile instrumente pe viitor.
- [Bootstrap 5](https://getbootstrap.com/) - librarie open-source css si javascript folosita pentru construirea interfetei grafice intr-un mod standardizat si responsive.
  
### Frontend
- HTML
- CSS
- JavaScript

### Backend
- PHP 8
- MariaDB 11
  
### Diverse:

- Github

## Cerinte de sistem:

- Conexiune la internet
- Un browser relativ modern

### Pentru rularea locala a proiectului este nevoie de:

- PHP 8
- Composer
- Server Apache
- MariaDB


## Paginile si structura site-ului:

### Designul:

-------------------------------

Designul este unul simplu, modern si minimalist, creat atat din clase utilitare, dar si cu ajutorul claselor oferite de Bootstrap.

Am avut grija ca aplicatia sa se adapteze corect atat unui ecran cu latime mare (desktop/laptop), cat si pe un ecran de marime medie (ca o tableta). Pentru ecranele mai mici, asemenea
celor gasite pe telefoane, interfata se adapteaza si reuseste sa isi pastreze in mare parte aceleasi capabilitati.

![a photo of the navbar, as it appears on a desktop](https://github.com/AndreicuD/ChimeShare/assets/78648231/1d6b59f0-32d7-40bd-ab51-f16e85a3f3fb)
![a photo of the navbar, as it appears on a phone](https://github.com/AndreicuD/ChimeShare/assets/78648231/2964da67-4fca-486e-a827-9a13f6fd230b)

### Structura:

-------------------------------

Structura pentru un utilizator fara cont (guest) este un simpla, asemenea majoritatii site-urilor de pe internet.

![a photo of the navbar, for a guest user](https://github.com/AndreicuD/ChimeShare/assets/78648231/7a591fdf-f832-44f1-a2c7-7a467ff5eda6)


Utilizatorul are acces la prima pagina, de unde poate asculta ultimele melodii urcate, sau melodiile cele mai apreciate de comunitate, dar si la paginile 'About' si 'Contact'.

![a photo of the contact form](https://github.com/AndreicuD/ChimeShare/assets/78648231/52a12c4d-8b2e-45d3-add9-6492d813b666)

Dupa ce utilizatorul isi face cont, el primeste dreptul de a:

1. Aprecia melodiile altui utilizator
2. Crea propriile melodii

Asa arata noua lui bara de navigatie:

![a photo of the new navbar, after the user logins](https://github.com/AndreicuD/ChimeShare/assets/78648231/d1777afd-24cd-4cb7-bc40-0c6b6964f073)

Pentru a isi crea propria melodie utilizatorul trebuie sa ajunga la pagina 'My Chimes': 

![a photo of the page My Chimes](https://github.com/AndreicuD/ChimeShare/assets/78648231/59101182-bfd5-4984-b39e-560755e6b578)

Aici va apasa butonul 'Make a New Chime!', care il va duce pe aceasta pagina:

![A website page that allows you to make your own melodies](https://github.com/AndreicuD/ChimeShare/assets/78648231/ebdbc2da-4c35-47df-90ae-4cba734c7b86)


Aici utilizatorul poate crea propriile melodii, el putand sa le asculte la diferite instrumente si tempo-uri, in functie de preferinte.

El poate alegea de asemenea sa salveze melodia, dupa terminarea acesteia, moment in care are de completat un formular.

Utilizatorul este liber sa aleaga daca isi doreste ca melodia lui sa fie publica, moment in care apare si pe prima pagina, la sectiunea 'Latest Chimes', sau sa o pastreze privata.


### Cum functioneaza in fundal:

-------------------------------

Gridul in care utilizatorul isi face muzica este de fapt generat pe loc cu ajutorul php-ului, in functie de anumite variabile decise de mine (lucru care imi permite pe viitor sa
extind tot proiectul, sau poate chiar sa il fac compatibil cu mai multe instrumente in acelasi timp). Fiecaruia din aceste butoane ii este dat un id unic, care urmeaza regula:
"c_r_", unde 'c' vine de la 'column/coloana', iar 'r' de la 'row/rand'. Fiecare buton are de asemeanea o legatura 'onclick' la o functie JavaScript care sparge id-ul
pentru a recunoaste exact ce nota are nevoie sa cante (in functie de randul in care se afla), iar care mai apoi genereaza un obiect care tine toate informatiile melodiei, a
notelor cantate. Astfel, acest obiect poate fi foarte usor salvat sub forma <b>JSON</b>, pentru a fi salvat eficient intr-o baza de date.

Fiecarei melodii ii este atribuita pe langa lucrurile de baza (nume si autor) si un id public, diferit fata de cel din baza de date. Acest lucru va permite
deschiderea pentru ascultarea melodiilor altor persoane pe baza unui simplu link, care poate fi distribuit usor si care va contine acel id public in structura lui.
Ex: [https://chime-share.com/chime/listen?id=548fd187-1945-11ef-b1cc-309c233d53c1](https://chime-share.com/chime/listen?id=548fd187-1945-11ef-b1cc-309c233d53c1)

In plus, fiecare melodie publica are de asemenea si un contor de like-uri, lucru care permite formarea acelei liste cu cele mai bune melodii pe care o gasim pe prima pagina
si care aduce elemente asemanatoare unui 'social media' pe platforma.

### Planuri de viitor:

-------------------------------

Imi doresc sa aduc pe platforma cat mai multe elemente sociale in viitor. Vreau, de exemplu, sa poti deschide pagina unui alt utilizator ca sa explorezi toate melodiile lui
publice, sa poti sa il urmaresti pe platforma, astfel aratandu-ti aprecierea. Structura proiectului in prezent permite dezvoltarea acestor functii
cu usurinta, astfel ca lista de melodii ale unui utilizator este strans legata de acesta si poate fi astfel extrasa din baza de date cu foarte putine interogari, fiind totul
foarte rapid.
