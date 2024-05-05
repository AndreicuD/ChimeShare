<?php
require_once dirname(__FILE__).'/lib/limonade.php';

function configure()
{
  option('env', ENV_DEVELOPMENT);
  option('base_uri', '/infoed2024');
}

function before($route = array())
{
  #print_r($route); exit;
  #inspect the $route array, looking at various options that may have been passed in
  if (!empty($route['options']['authenticate'])) {
    authenticate_user() or halt("Access denied");
  }
}

function after($output, $route)
{
  $time = number_format( microtime(true) - LIM_START_MICROTIME, 6);
  $output .= "\n<!-- page rendered in $time sec., on ".date(DATE_RFC822)." -->\n";
  $output .= "<!-- for route\n";
  $output .= print_r($route, true);
  $output .= "-->";
  return $output;
}

//------------------------------
//  Routes
//------------------------------
dispatch('/', 'frontend_index');
dispatch('/melody-maker', 'frontend_melody');
dispatch('/about', 'frontend_about');
dispatch('/contact', 'frontend_contact');
dispatch('/account', 'user_account', array("authenticate" => TRUE));

//------------------------------
//  Utilities
//------------------------------
function authenticate_user()
{
  //auth the user here...
  return true;
}

# START APP
run();