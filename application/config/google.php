<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '490037150517-msb0lb6tieagnmdtmqdoqhfaen4lfcvj.apps.googleusercontent.com';
$config['google']['client_secret']    = 'h2CJbebBtysrd6AVopRGl2XY';
$config['google']['redirect_uri']     = base_url().'Shop/google';
$config['google']['application_name'] = 'Login to AQUADEAL SHOP';
$config['google']['api_key']          = 'AIzaSyDwVPvoIGjGnvZpTymHGAQYWwTZr8tARgg';
$config['google']['scopes']           = array();

?>