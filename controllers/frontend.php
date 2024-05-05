<?php

function frontend_index()
{
    set('page_name', 'Melody Maker');
    set('meta_title', 'Melody Maker | Info-Educatie-2024');
    set('meta_description', '');
    return render('frontend/index.php', 'home_layout.php');
}

function frontend_melody()
{
    set('page_name', 'Melody maker');
    set('meta_title', 'Melody Maker | Info-Educatie-2024');
    set('meta_description', '');
    return render('frontend/melody.php', 'default_layout.php');
}


function frontend_about()
{
    set('page_name', 'About Us');
    set('meta_title', 'About Us | Melody Maker | Info-Educatie-2024');
    set('meta_description', '');
    return render('frontend/about.php', 'default_layout.php');
}

function frontend_contact()
{
    set('page_name', 'Contact');
    set('meta_title', 'Contact | Melody Maker | Info-Educatie-2024');
    set('meta_description', '');
    return render('frontend/contact.php', 'default_layout.php');
}