<p align="center">
    <!--<a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>-->
    <h1 align="center">ChimeShare Documentation</h1>
    <br>
</p>

<h1>RO</h1>

Acest proiect este bazat pe frameworkul de PHP [Yii](https://www.yiiframework.com/) si pe libraria [Tone.js](https://tonejs.github.io/), utilizata pentru a genera sunetul instrumentelor.

## Technologii utilizate:

- JavaScript
- Github

### Externe:

- Yii - framework care se ocupa de rutare, viewuri si alte elemente de securitate care previn atacurile nedorite.
- Tone.js - librarie de JavaScript care genereaza sunetele diferitelor instrumente pe loc, in functie de anumiti parametri setati in cod. Va permite si user-ului sa isi creeze propriile instrumente pe viitor.
  
### Frontend
- HTML
- CSS
- Bootstrap

### Backend
- PHP 8.2
- MariaDB 11.3

## Cerinte de sistem:

- Conexiune la internet
- Un browser relativ modern

### Pentru rularea locala a proiectului este nevoie de:

- PHP 8.2
- Server Apache
- MariaDB

## Paginile si structura site-ului:

### Designul:

-------------------------------

Designul este unul simplu, modern si minimalist, creat atat din clase utilitare, dar si cu ajutorul claselor oferite de Bootstrap.

Am avut grija ca aplicatia sa se adapteze corect atat unui ecran cu latime mare (desktop/laptop), cat si pe unui ecran de marime medie (ca o tableta).Pentru ecranele mai mici, asemenea
celor gasite pe telefoane, interfata se adapteaza si reuseste sa isi pastreze in mare parte aceleasi capabilitati.

![a photo of the navbar, as it appears on a phone](https://github.com/AndreicuD/ChimeShare/assets/78648231/04c3df81-45f5-439b-9638-35f9be7f79bd)

Probleme pot aparea insa atunci cand se doreste crearea unei melodii de pe telefon, interfata avand de suferit datorita limitarilor impuse de designul ales.

![a photo of the melody-maker page, as it appear on a phone](https://github.com/AndreicuD/ChimeShare/assets/78648231/fc42bfba-1790-40e2-a551-f7a24e003bf2)

### Structura:

-------------------------------

Structura pentru un utilizator fara cont (guest) este un simpla, asemenea majoritatii site-urilor de pe internet.

![a photo of the navbar, for an guest user](https://github.com/AndreicuD/ChimeShare/assets/78648231/4b54ae45-7541-475d-b58a-26922e38aed1)

Utilizatorul are acces la prima pagina, de unde poate asculta ultimele melodii urcate, sau melodiile cele mai apreciate de comunitate, dar si la paginile 'About' si 'Contact'.

![a photo of the contact form](https://github.com/AndreicuD/ChimeShare/assets/78648231/dc6cefe5-c5b5-4795-b8d6-d44fc40f7650)

Dupa ce utilizatorul isi face cont, el primeste dreptul de a:

1. Isi arata aprecierea pentru melodia altui utilizator
2. Isi face propriile melodii

Asa arata noua lui bara de navigatie:

![a photo of the new navbar, after the user logins](https://github.com/AndreicuD/ChimeShare/assets/78648231/ad041128-d708-4808-8b53-aa4676b0b2a4)

Pentru a isi crea propria melodie utilizatorul trebuie sa ajunga la pagina 'My Chimes' de unde va apasa butonul 'Create Chime', care il va duce pe aceasta pagina:

![A website page that allows you to make your own melodies](https://github.com/AndreicuD/ChimeShare/assets/78648231/3b1297e6-ae26-4404-908d-ed717b141681)

Aici utilizatorul poate crea propriile melodii, el putand sa le asculte la diferite instrumente si tempo-uri, in functie de preferinte.

El poate alegea de asemenea sa salveze melodia, dupa terminarea acesteia, moment in care are de completat un formular.

Utilizatorul este liber sa aleaga daca isi doreste ca melodia lui sa fie publica, moment in care apare si pe prima pagina, la sectiunea 'Latest Chimes', sau sa o pastreze privata.
