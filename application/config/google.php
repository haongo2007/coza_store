<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/

$config['google_client_id']			=	"1036666696166-pc1vd85v1j15a37q4vuif5adg61kefeg.apps.googleusercontent.com";
$config['google_client_secret']		=	"M8KWauTB-BeRi1Oj2ug-1crG";
$config['google_redirect_url']		=	base_url('user/g_callback');
$config['google_application_name'] 	= 	'Login to coza-store';
$config['google_api_key']          	= 	'';
$config['google_scopes']           	= 	array();