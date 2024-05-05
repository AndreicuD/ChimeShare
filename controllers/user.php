<?php

function user_account()
{
    set('page_name', 'User account');
    set('meta_title', 'User account | Melody Maker | Info-Educatie-2024');
    set('meta_description', '');
    return render('user/account.php', 'default_layout.php');
}